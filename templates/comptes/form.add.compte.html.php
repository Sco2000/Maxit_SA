<?php $errors = $this->session->get('errors'); $this->session->unset('errors'); ?>
<?php $errorSolde = $this->session->get('error_solde'); $this->session->unset('error_solde'); ?>
<?php $succes = $this->session->get('success'); $this->session->unset('success'); ?>

<div class="min-h-screen z-0 bg-gradient-to-br from-slate-50 to-blue-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header with gradient -->
            <div class="bg-gradient-to-r from-orange-500 to-red-500 p-6 text-center">
                <div class="flex items-center justify-center mb-3">
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white mb-1">MAXITSA</h1>
                <p class="text-orange-100">Ajouter un compte secondaire</p>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <!-- Success Message -->
                <?php if($succes): ?>
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-emerald-800 font-medium"><?= $succes ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Form -->
                <form class="space-y-6" method="post" action="/add_compte_secondaire">
                    <!-- Telephone Field -->
                    <div class="space-y-2">
                        <label for="telephone" class="block text-sm font-semibold text-slate-700 uppercase tracking-wide">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>Téléphone</span>
                            </div>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-slate-500 text-sm">+221</span>
                            </div>
                            <input 
                                name="telephone"
                                type="text" 
                                class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 bg-slate-50 hover:bg-white focus:bg-white placeholder-slate-400"
                                placeholder="Entrez le numéro de téléphone"
                            >
                        </div>
                        <?php if(isset($errors['telephone'])): ?>
                            <div class="flex items-center space-x-2 text-red-600">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm font-medium"><?= $errors['telephone'] ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Solde Field -->
                    <div class="space-y-2">
                        <label for="solde" class="block text-sm font-semibold text-slate-700 uppercase tracking-wide">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span>Solde Initial</span>
                            </div>
                        </label>
                        <div class="relative">
                            <input 
                                name="solde"
                                type="number" 
                                min="0"
                                step="1"
                                class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 bg-slate-50 hover:bg-white focus:bg-white placeholder-slate-400"
                                placeholder="Entrez le solde initial"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-slate-500 text-sm font-medium">FCFA</span>
                            </div>
                        </div>
                        <?php if(isset($errors['solde'])): ?>
                            <div class="flex items-center space-x-2 text-red-600">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm font-medium"><?= $errors['solde'] ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col space-y-3 pt-4">
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold py-3 px-6 rounded-xl hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Ajouter le compte</span>
                        </button>
                        
                        <a 
                            href="<?php $url ?>transactions"
                            class="w-full bg-slate-100 text-slate-700 font-semibold py-3 px-6 rounded-xl hover:bg-slate-200 transition-all duration-200 flex items-center justify-center space-x-2 border-2 border-slate-200 hover:border-slate-300"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Annuler</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Info Card -->
        <div class="mt-6 bg-white/70 backdrop-blur-sm rounded-xl p-4 border border-white/50">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 mt-0.5">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-slate-700 mb-1">Information</h4>
                    <p class="text-xs text-slate-600">Le compte secondaire sera créé avec le solde initial que vous spécifiez. Vous pourrez le modifier plus tard si nécessaire.</p>
                </div>
            </div>
        </div>
    </div>
</div>