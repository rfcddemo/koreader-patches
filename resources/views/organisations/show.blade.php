@extends('layouts.app')

@section('title', $organisation->raison_sociale)

@section('page-header')
    <div class="flex justify-between items-start">
        <div class="flex items-start space-x-4">
            @if($organisation->logo_path)
                <img src="{{ $organisation->logo_url }}"
                     alt="Logo {{ $organisation->raison_sociale }}"
                     class="w-16 h-16 rounded-xl object-cover border border-slate-200">
            @else
                <div class="w-16 h-16 bg-slate-200 rounded-xl flex items-center justify-center border border-slate-200">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            @endif
            <div>
                <h1 class="text-2xl font-bold text-slate-900">{{ $organisation->raison_sociale }}</h1>
                <div class="flex items-center space-x-4 mt-2">
                    @if($organisation->actif)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-error">Inactive</span>
                    @endif
                    @if($organisation->ville || $organisation->pays)
                        <span class="text-slate-600">
                            {{ $organisation->ville }}{{ $organisation->ville && $organisation->pays ? ', ' : '' }}{{ $organisation->pays }}
                        </span>
                    @endif
                </div>
                @if($organisation->site_web)
                    <a href="{{ $organisation->site_web }}" target="_blank"
                       class="text-blue-600 hover:text-blue-800 text-sm mt-1 inline-flex items-center">
                        {{ $organisation->site_web }}
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('organisations.index') }}" class="btn btn-outline btn-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour à la liste
            </a>
            @can('update', $organisation)
                <a href="{{ route('organisations.edit', $organisation) }}" class="btn btn-primary btn-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Modifier
                </a>
            @endcan
        </div>
    </div>
@endsection

@section('content')
    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-purple-50 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Investisseurs</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $stats['investors_total'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Investisseurs Actuels</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $stats['investors_actuels'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-50 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Contacts</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $stats['contacts_total'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-amber-50 rounded-lg">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Contacts Actuels</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $stats['contacts_actuels'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Informations principales -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Détails de l'organisation -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">Informations détaillées</h2>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($organisation->adresse)
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Adresse</dt>
                                <dd class="mt-1 text-sm text-slate-900">{{ $organisation->adresse }}</dd>
                            </div>
                        @endif

                        @if($organisation->ville)
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Ville</dt>
                                <dd class="mt-1 text-sm text-slate-900">{{ $organisation->ville }}</dd>
                            </div>
                        @endif

                        @if($organisation->pays)
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Pays</dt>
                                <dd class="mt-1 text-sm text-slate-900">{{ $organisation->pays }}</dd>
                            </div>
                        @endif

                        @if($organisation->telephone)
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Téléphone</dt>
                                <dd class="mt-1 text-sm text-slate-900">
                                    <a href="tel:{{ $organisation->telephone }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $organisation->telephone }}
                                    </a>
                                </dd>
                            </div>
                        @endif

                        @if($organisation->fax)
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Fax</dt>
                                <dd class="mt-1 text-sm text-slate-900">{{ $organisation->fax }}</dd>
                            </div>
                        @endif

                        @if($organisation->email)
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Email</dt>
                                <dd class="mt-1 text-sm text-slate-900">
                                    <a href="mailto:{{ $organisation->email }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $organisation->email }}
                                    </a>
                                </dd>
                            </div>
                        @endif
                    </dl>

                    @if($organisation->description)
                        <div class="mt-6 pt-6 border-t border-slate-200">
                            <dt class="text-sm font-medium text-slate-500 mb-2">Description</dt>
                            <dd class="text-sm text-slate-900 leading-relaxed">{{ $organisation->description }}</dd>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Investisseurs liés -->
            @if($organisation->investors->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-900">
                            Investisseurs ({{ $organisation->investors->count() }})
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($organisation->investors as $investor)
                                <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg">
                                    <div class="flex items-center">
                                        <img class="h-10 w-10 rounded-full object-cover"
                                             src="https://ui-avatars.com/api/?name={{ urlencode($investor->nom_complet) }}&color=2563eb&background=e0e7ff"
                                             alt="{{ $investor->nom_complet }}">
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-slate-900">{{ $investor->nom_complet }}</p>
                                            @if($investor->pivot->poste)
                                                <p class="text-sm text-slate-500">{{ $investor->pivot->poste }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if($investor->pivot->actuel)
                                            <span class="badge badge-success badge-sm">Actuel</span>
                                        @else
                                            <span class="badge badge-outline badge-sm">Ancien</span>
                                        @endif
                                        <a href="#"
                                           class="btn btn-ghost btn-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Actions rapides -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Actions</h3>
                <div class="space-y-3">
                    @can('update', $organisation)
                        <a href="{{ route('organisations.edit', $organisation) }}"
                           class="btn btn-outline btn-sm w-full justify-start">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Modifier l'organisation
                        </a>
                    @endcan

                    @if($organisation->email)
                        <a href="mailto:{{ $organisation->email }}"
                           class="btn btn-outline btn-sm w-full justify-start">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Envoyer un email
                        </a>
                    @endif

                    @if($organisation->site_web)
                        <a href="{{ $organisation->site_web }}" target="_blank"
                           class="btn btn-outline btn-sm w-full justify-start">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                            </svg>
                            Visiter le site web
                        </a>
                    @endif

                    @can('delete', $organisation)
                        <button onclick="confirmDelete()"
                                class="btn btn-error btn-outline btn-sm w-full justify-start">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Supprimer
                        </button>
                    @endcan
                </div>
            </div>

            <!-- Métadonnées -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Informations système</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Créée le</dt>
                        <dd class="mt-1 text-sm text-slate-900">{{ $organisation->created_at->format('d/m/Y à H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Modifiée le</dt>
                        <dd class="mt-1 text-sm text-slate-900">{{ $organisation->updated_at->format('d/m/Y à H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    @can('delete', $organisation)
        <dialog id="delete-modal" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg text-red-600">Confirmer la suppression</h3>
                <p class="py-4">
                    Êtes-vous sûr de vouloir supprimer l'organisation <strong>{{ $organisation->raison_sociale }}</strong> ?
                    Cette action est irréversible.
                </p>
                <div class="modal-action">
                    <form method="POST" action="{{ route('organisations.destroy', $organisation) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn" onclick="document.getElementById('delete-modal').close()">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-error">
                            Supprimer définitivement
                        </button>
                    </form>
                </div>
            </div>
        </dialog>
    @endcan
@endsection

@push('breadcrumbs')
    <li>
        <a href="{{ route('organisations.index') }}" class="text-blue-600 hover:text-blue-700">
            Organisations
        </a>
    </li>
    <li>
        <span class="text-slate-500">{{ $organisation->raison_sociale }}</span>
    </li>
@endpush

@push('scripts')
    <script>
        function confirmDelete() {
            document.getElementById('delete-modal').showModal();
        }
    </script>
@endpush
