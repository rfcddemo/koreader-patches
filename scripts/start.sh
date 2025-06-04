#!/bin/bash

# Script de démarrage pour CRM Investisseurs
# Compatible Linux et macOS

set -e

# Couleurs pour l'output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Variables
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_DIR="$(dirname "$SCRIPT_DIR")"
ENV_FILE="$PROJECT_DIR/.env"
DOCKER_ENV_FILE="$PROJECT_DIR/.env.docker"

# Fonctions utilitaires
log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Vérification des prérequis
check_requirements() {
    log_info "Vérification des prérequis..."

    if ! command -v docker &> /dev/null; then
        log_error "Docker n'est pas installé"
        exit 1
    fi

    if ! command -v docker-compose &> /dev/null && ! docker compose version &> /dev/null; then
        log_error "Docker Compose n'est pas installé"
        exit 1
    fi

    log_success "Prérequis vérifiés"
}

# Détection du système d'exploitation
detect_os() {
    if [[ "$OSTYPE" == "darwin"* ]]; then
        OS="macos"
    elif [[ "$OSTYPE" == "linux"* ]]; then
        OS="linux"
    else
        log_warning "Système d'exploitation non supporté: $OSTYPE"
        OS="unknown"
    fi
    log_info "Système détecté: $OS"
}

# Configuration de l'environnement
setup_environment() {
    log_info "Configuration de l'environnement..."

    # Copie du fichier .env.docker vers .env s'il n'existe pas
    if [ ! -f "$ENV_FILE" ]; then
        if [ -f "$DOCKER_ENV_FILE" ]; then
            cp "$DOCKER_ENV_FILE" "$ENV_FILE"
            log_success "Fichier .env créé à partir de .env.docker"
        else
            log_error "Fichier .env.docker introuvable"
            exit 1
        fi
    else
        log_warning "Fichier .env existe déjà"
    fi

    # Création des répertoires nécessaires
    mkdir -p "$PROJECT_DIR/storage/logs/nginx"
    mkdir -p "$PROJECT_DIR/storage/logs/postgres"
    mkdir -p "$PROJECT_DIR/docker/nginx/ssl"

    # Permissions pour macOS/Linux
    if [ "$OS" != "unknown" ]; then
        chmod -R 755 "$PROJECT_DIR/storage"
        chmod -R 755 "$PROJECT_DIR/bootstrap/cache" 2>/dev/null || true
    fi

    log_success "Environnement configuré"
}

# Fonction pour utiliser docker-compose ou docker compose
docker_compose_cmd() {
    if command -v docker-compose &> /dev/null; then
        echo "docker-compose"
    else
        echo "docker compose"
    fi
}

# Construction des images Docker
build_images() {
    log_info "Construction des images Docker..."

    local compose_cmd=$(docker_compose_cmd)

    $compose_cmd build --no-cache

    log_success "Images construites"
}

# Démarrage des services
start_services() {
    log_info "Démarrage des services..."

    local compose_cmd=$(docker_compose_cmd)

    # Démarrage en arrière-plan
    $compose_cmd up -d

    log_success "Services démarrés"
}

# Installation des dépendances
install_dependencies() {
    log_info "Installation des dépendances..."

    local compose_cmd=$(docker_compose_cmd)

    # Attendre que les services soient prêts
    sleep 10

    # Installation des dépendances Composer
    log_info "Installation des dépendances PHP..."
    $compose_cmd exec app composer install --no-interaction --prefer-dist

    # Installation des dépendances Node.js
    log_info "Installation des dépendances Node.js..."
    $compose_cmd exec node npm install
    log_info "Compilation des assets..."
    $compose_cmd exec node npm run build

    log_success "Dépendances installées"
}

# Configuration de Laravel
setup_laravel() {
    log_info "Configuration de Laravel..."

    local compose_cmd=$(docker_compose_cmd)

    # Génération de la clé d'application si nécessaire
    if ! grep -q "APP_KEY=" "$ENV_FILE" || grep -q "APP_KEY=$" "$ENV_FILE"; then
        log_info "Génération de la clé d'application..."
        $compose_cmd exec app php artisan key:generate --force
    fi

    # Attendre que PostgreSQL soit prêt
    log_info "Attente de PostgreSQL..."
    $compose_cmd exec app sh -c 'while ! pg_isready -h postgres -p 5432 -U crm_user; do sleep 1; done'

    # Exécution des migrations
    log_info "Exécution des migrations..."
    $compose_cmd exec app php artisan migrate --force

    # Exécution des seeders (optionnel)
    if [ "$1" == "--seed" ]; then
        log_info "Exécution des seeders..."
        $compose_cmd exec app php artisan db:seed --force
    fi

    # Configuration du cache
    log_info "Configuration du cache..."
    $compose_cmd exec app php artisan config:cache
    $compose_cmd exec app php artisan route:cache
    $compose_cmd exec app php artisan view:cache

    # Création du lien symbolique pour le storage
    $compose_cmd exec app php artisan storage:link

    log_success "Laravel configuré"
}

# Affichage des informations de connexion
display_info() {
    echo ""
    log_success "🚀 CRM Investisseurs démarré avec succès!"
    echo ""
    echo -e "${BLUE}📱 Application:${NC}           http://localhost"
    echo -e "${BLUE}🗄️  pgAdmin:${NC}             http://localhost:8080"
    echo -e "${BLUE}📧 Mailpit:${NC}              http://localhost:8025"
    echo -e "${BLUE}⚡ Vite Dev Server:${NC}      http://localhost:5173"
    echo ""
    echo -e "${YELLOW}Identifiants pgAdmin:${NC}"
    echo -e "  Email: admin@crm-invest.local"
    echo -e "  Mot de passe: admin123"
    echo ""
    echo -e "${GREEN}Pour arrêter:${NC} ./scripts/stop.sh"
    echo -e "${GREEN}Pour les logs:${NC} docker-compose logs -f"
    echo ""
}

# Vérification si c'est le premier démarrage
is_first_run() {
    local compose_cmd=$(docker_compose_cmd)
    ! $compose_cmd ps | grep -q "Up"
}

# Script principal
main() {
    echo -e "${GREEN}"
    echo "╔══════════════════════════════════════════════════════════════╗"
    echo "║                    CRM INVESTISSEURS                         ║"
    echo "║                  Bank of Africa                              ║"
    echo "╚══════════════════════════════════════════════════════════════╝"
    echo -e "${NC}"

    cd "$PROJECT_DIR"

    check_requirements
    detect_os
    setup_environment

    local first_run=false
    if is_first_run; then
        first_run=true
        log_info "Premier démarrage détecté"
    fi

    if [ "$first_run" = true ]; then
        build_images
    fi

    start_services

    if [ "$first_run" = true ]; then
        install_dependencies
        setup_laravel "$@"
    fi

    display_info
}

# Gestion des options
case "${1:-}" in
    --rebuild)
        log_info "Reconstruction forcée des images..."
        build_images
        start_services
        install_dependencies
        setup_laravel "${@:2}"
        display_info
        ;;
    --seed)
        main --seed
        ;;
    --help|help)
        echo "Usage: $0 [options]"
        echo ""
        echo "Options:"
        echo "  --rebuild    Force la reconstruction des images Docker"
        echo "  --seed       Exécute les seeders après les migrations"
        echo "  --help       Affiche cette aide"
        exit 0
        ;;
    *)
        main "$@"
        ;;
esac
