# CRM Investisseurs - Bank of Africa

## 📋 CONTEXTE PROJET
**Client**: Bank of Africa - Direction de la Communication Financière  
**Type**: Application web CRM interne sécurisée  
**Objectif**: Centraliser et gérer les relations avec les investisseurs  
**Démarré**: Mai 2025
## 🛠️ STACK TECHNIQUE
**Backend**: Laravel 12 + PHP 8.4 + MySQL 8.0  
**Frontend**: TailwindCSS + DaisyUI + AlpineJS  
**Authentification**: Laravel Sanctum + Spatie Permissions  
**Assets**: Vite + Node.js  
**Environnement**: Mac + MAMP/Laravel Serve

## 🎯 FONCTIONNALITÉS PRINCIPALES
- **Gestion des investisseurs**: CRUD complet avec fiches détaillées
- **Système d'interactions**: Emails, appels, réunions avec historique
- **Module emails**: Envoi/réception automatisé avec adresses uniques
- **Gestion des droits**: 3 niveaux (Administrateur/Éditeur/Lecture seule)
- **Recherche avancée**: Filtres multiples et recherche full-text
- **Exports**: Excel, PDF, CSV avec colonnes personnalisables
- **Dashboard**: Analytics et statistiques en temps réel
- **Journalisation**: Traçabilité complète des actions utilisateurs

## 📊 STRUCTURE BASE DE DONNÉES
**Tables principales**:
- `users`: Utilisateurs avec rôles Spatie (nom_complet, email, téléphone, statut)
- `investors`: Fiches investisseurs (nom_complet, catégorie, pays, email unique, organisation, fonction, langue_preferee, remarques)
- `interactions`: Historique des échanges (type, date, description, pièces jointes, metadata)
- `investor_email_addresses`: Emails uniques générés (investor-XXXX@crm.ir-boa.com)
- `roles` & `permissions`: Système d'autorisation Spatie

**Relations clés**:
- User → hasMany → Interactions
- Investor → hasMany → Interactions
- Investor → hasOne → InvestorEmailAddress

## 👥 RÔLES & PERMISSIONS
**Administrateur**: Accès complet + gestion utilisateurs + exports + logs  
**Éditeur**: CRUD investisseurs + interactions + envoi emails (pas de suppression)  
**Lecture seule**: Consultation uniquement des fiches et historiques

## 🎨 DESIGN & UI/UX
**Thème**: Corporate Bank of Africa (bleu #2563eb)  
**Style**: Professionnel bancaire avec gradients et glass effects  
**Navigation**: Sidebar collapsible avec icônes + textes  
**Responsive**: Mobile-first avec menu burger  
**Animations**: AlpineJS pour micro-interactions fluides  
**Composants**: DaisyUI (cards, forms, buttons, modals, tables)

## ✅ DÉVELOPPEMENT ACTUEL
**Terminé**:
- ✅ Setup Laravel 12 + packages essentiels
- ✅ Base de données complète avec migrations + seeders
- ✅ Authentification avec design BOA professionnel
- ✅ Dashboard responsive avec sidebar collapsible
- ✅ Système de rôles et permissions fonctionnel
- ✅ Layout principal avec header/footer professionnels

**Utilisateurs de test créés**:
- Admin: admin@bankofafrica.com / password123
- Éditeur: houda@bankofafrica.com / password123
- Lecture: ahmed@bankofafrica.com / password123

**En cours/À développer**:
- 🔄 Interface de gestion des investisseurs (CRUD)
- ⏳ Module d'interactions avec timeline
- ⏳ Système d'envoi/réception d'emails automatisé
- ⏳ Recherche avancée avec filtres dynamiques
- ⏳ Exports Excel/PDF personnalisables
- ⏳ Rapports et analytics avancés

## 🔧 PACKAGES INSTALLÉS
**Backend**:
- spatie/laravel-permission (rôles & permissions)
- spatie/laravel-activitylog (journalisation)
- maatwebsite/excel (exports Excel)
- barryvdh/laravel-dompdf (génération PDF)
- intervention/image (traitement images)

**Frontend**:
- tailwindcss + daisyui (UI framework)
- alpinejs (interactivité)
- @tailwindcss/forms + @tailwindcss/typography

## 📝 SPÉCIFICATIONS MÉTIER
**Catégories d'investisseurs**: Institutionnel, Analyste, Particulier, Fonds, Banque  
**Types d'interactions**: Email, Appel, Réunion, Email envoyé, Email reçu, Autre  
**Langues supportées**: Français, Anglais, Arabe  
**Formats d'export**: XLSX, CSV, PDF avec templates personnalisés  
**Sécurité**: Chiffrement des données, logs d'audit, accès par rôles

## 🔧 CONFIGURATION SERVEUR
**Port de développement**: 8080 (php artisan serve --port=8080)  
**Base de données**: MySQL `crm_investisseurs`  
**Memory limit**: 512M (pour éviter erreurs de mémoire)  
**Assets compilation**: npm run dev (mode watch)
