<?php $user=$this->session->get('user'); extract($user); ?>
<div class="w-80 bg-gradient-to-b fixed h-[100vh] from-slate-900 via-slate-800 to-slate-900 text-white flex flex-col justify-between shadow-2xl border-r border-slate-700">
    <!-- Logo Section -->
    <div class="p-8">
        <div class="relative">
            <div class="bg-gradient-to-r from-orange-500 to-red-600 text-white px-6 py-4 rounded-2xl font-bold text-2xl w-fit shadow-lg transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    <span>MAXITSA</span>
                </div>
            </div>
            <div class="absolute -top-2 -right-2 w-4 h-4 bg-green-400 rounded-full border-2 border-white animate-pulse"></div>
        </div>
        <p class="text-slate-400 mt-3 text-sm">Gestionnaire financier</p>
    </div>
    
    <!-- Navigation Section -->
    <nav class="flex-1 px-4 space-y-2">
        <div class="mb-6">
            <p class="text-slate-400 text-xs uppercase tracking-wider font-semibold px-4 mb-3">Navigation</p>
        </div>
        
        <!-- Active Item - Transactions -->
        
        <div class="space-y-2">
             <a href="<?php $url ?>list_transactions">
                 <div class="relative">
                     <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-xl p-4 shadow-lg">
                         <div class="flex items-center space-x-3">
                             <div class="p-2 bg-white/20 rounded-lg">
                                 <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                 </svg>
                             </div>
                             <span class="font-semibold text-white">Transactions</span>
                         </div>
                     </div>
                     <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-1 h-8 bg-white rounded-r-full -ml-4"></div>
                 </div>
             </a>
             <!-- Navigation Items -->
              <a href="<?php $url ?>liste_comptes?page=1">
                  <div class="group">
                      <div class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white cursor-pointer transition-all duration-200">
                          <div class="p-2 bg-slate-700 rounded-lg group-hover:bg-slate-600 transition-colors">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                              </svg>
                          </div>
                          <span class="font-medium">Mes comptes</span>
                          <svg class="w-4 h-4 ml-auto transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                          </svg>
                      </div>
                  </div>
              </a>
             
              <a href="<?php $url ?>form_add_compte">
                  <div class="group">
                      <div class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white cursor-pointer transition-all duration-200">
                          <div class="p-2 bg-slate-700 rounded-lg group-hover:bg-slate-600 transition-colors">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                              </svg>
                          </div>
                          <span class="font-medium">Ajouter un compte</span>
                          <svg class="w-4 h-4 ml-auto transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                          </svg>
                      </div>
                  </div>
              </a>

              <a href="#" id="paiement-link">
                <div class="group">
                    <div class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white cursor-pointer transition-all duration-200">
                        <div class="p-2 bg-slate-700 rounded-lg group-hover:bg-slate-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m4 0h-1v4h-1m-4 0h-1v-4h-1"></path>
                            </svg>
                        </div>
                        <span class="font-medium">Paiement électricité</span>
                        <svg class="w-4 h-4 ml-auto transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>
         </div>
        
    </nav>
    
    <!-- User Section & Logout -->
    <div class="p-6 border-t border-slate-700">
        <div class="bg-slate-800 rounded-xl p-4 mb-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl text-white font-bold text-slate-800 mb-2"><?php echo $prenom.' '. $nom ?></h1>
                    <p class="text-slate-400 text-sm">Connecté</p>
                </div>
            </div>
        </div>
        
        <a href="<?php $url ?>logout" class="block w-full">
            <button class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-3 rounded-xl font-medium transition-all duration-200 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Se déconnecter</span>
            </button>
        </a>
    </div>
</div>

<!-- Formulaire Paiement (overlay global) -->
<div id="paiement-form-container" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-8 shadow-2xl w-[350px]">
        <h2 class="text-xl font-bold mb-4 text-slate-800">Acheter de l'électricité</h2>
        <form id="paiement-form" class="space-y-4">
            <div>
                <label for="compteur" class="block text-sm font-medium text-slate-700">Numéro de compteur</label>
                <input type="text" id="compteur" name="compteur" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                <span id="compteur-error" class="text-red-500 text-xs"></span>
            </div>
            <div>
                <label for="montant" class="block text-sm font-medium text-slate-700">Montant (FCFA)</label>
                <input type="number" id="montant" name="montant" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                <span id="montant-error" class="text-red-500 text-xs"></span>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="paiement-cancel" class="px-4 py-2 rounded bg-slate-300 text-slate-700 hover:bg-slate-400">Annuler</button>
                <button type="submit" class="px-4 py-2 rounded bg-orange-500 text-white hover:bg-orange-600">Valider</button>
            </div>
            <span id="paiement-success" class="text-green-500 text-xs"></span>
            <span id="paiement-fail" class="text-red-500 text-xs"></span>
        </form>
    </div>
</div>
<script src="/js/paiement.js"></script>