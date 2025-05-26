@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-header')
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
            <p class="text-slate-600 mt-1">Vue d'ensemble de votre CRM Investisseurs</p>
        </div>
        <div class="flex space-x-3">
            <button class="btn btn-outline btn-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0l-4 4m4-4v12"></path>
                </svg>
                Export
            </button>
            <a href="#" class="btn btn-primary btn-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Nouvel investisseur
            </a>
        </div>
    </div>
@endsection

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-50 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Investisseurs</p>
                    <p class="text-2xl font-bold text-slate-900">5</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Interactions ce mois</p>
                    <p class="text-2xl font-bold text-slate-900">12</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-amber-50 rounded-lg">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Emails envoyés</p>
                    <p class="text-2xl font-bold text-slate-900">8</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-purple-50 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Rapports générés</p>
                    <p class="text-2xl font-bold text-slate-900">3</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Activité récente</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                    <div class="flex-1">
                        <p class="text-sm text-slate-900">Nouvel investisseur ajouté: <strong>Jean-Pierre Dubois</strong></p>
                        <p class="text-xs text-slate-500">Il y a 2 heures</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                    <div class="flex-1">
                        <p class="text-sm text-slate-900">Email envoyé à <strong>Sarah Mitchell</strong></p>
                        <p class="text-xs text-slate-500">Il y a 4 heures</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-2 h-2 bg-amber-400 rounded-full"></div>
                    <div class="flex-1">
                        <p class="text-sm text-slate-900">Rapport trimestriel généré</p>
                        <p class="text-xs text-slate-500">Hier à 14:30</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumbs')
    <li>
        <span class="text-slate-500">Dashboard</span>
    </li>
@endpush
