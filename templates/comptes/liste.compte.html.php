<?php $pagination = $this->session->get('all_comptes'); if($pagination) extract($pagination) ?>
<?php $error = $this->session->get('error'); $this->session->unset('error'); ?>
<?php $success = $this->session->get('success'); $this->session->unset('success'); ?>
<div class="min-h-screen absolute w-full bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="w-full flex-1 flex flex-col p-6 mx-auto">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800 mb-2">Mes Comptes</h1>
                    <p class="text-slate-600">Gérez vos comptes principal et secondaires</p>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Accounts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if($comptes): ?>
                <?php foreach($comptes as $compte): ?>
                    <?php
                        $etat = $compte->getEtat()->value;
                        $headerClass = match($etat) {
                            'principal' => 'bg-gradient-to-r from-emerald-500 to-teal-600',
                            'secondaire' => 'bg-gradient-to-r from-orange-500 to-red-500',
                            default => 'bg-gradient-to-r from-gray-500 to-gray-600',
                        };
                        $badgeClass = match($etat) {
                            'principal' => 'bg-green-200 text-emerald-800',
                            'secondaire' => 'bg-white text-orange-800',
                            default => 'bg-white text-gray-800',
                        };
                    ?>
            <!-- Compte -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-slate-200 hover:shadow-xl transition-shadow duration-300">
                <div class="<?= $headerClass?> p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-white font-bold text-lg">Compte <?php echo $compte->getEtat()->value ?> </h3>
                            </div>
                        </div>
                        <div class="<?= $badgeClass ?> px-3 py-1 rounded-full text-xs font-semibold">
                            <?php echo $compte->getEtat()->value ?>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-slate-600 text-sm mb-1">Numéro de téléphone</p>
                        <p class="text-slate-800 font-semibold text-lg">+221 <?php echo $compte->getTelephone()?></p>
                    </div>
                    <div class="mb-4">
                        <p class="text-slate-600 text-sm mb-1">Solde disponible</p>
                        <p class="text-slate-800 font-bold text-2xl">
                            <?php echo $compte->getSolde()?> <span class="text-slate-500 text-sm font-normal">FCFA</span>
                        </p>
                    </div>
                    <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                        <?php if($compte->getEtat()->value == 'secondaire'): ?>
                            <form method="post" action="/definir_compte_principal">
                                <input type="hidden" name="id" value="<?= $compte->getId() ?>">
                                <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-4 py-3 rounded-xl font-medium transition-all duration-200 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-2">
                                        Changer en compte principal
                                </button>
                            </form>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

            <div class="flex justify-center space-x-2 mt-4">
                <?php for($i=1; $i<=$pages; $i++): ?>
                    <a href="<?php $url ?>liste_comptes?page=<?= $i ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Action Buttons -->
        <!-- <div class="flex justify-center space-x-4 mt-8">
            <button class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-semibold rounded-xl shadow-lg hover:from-emerald-600 hover:to-teal-700 transform hover:scale-105 transition-all duration-200 space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Ajouter un compte</span>
            </button>
            <button class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-blue-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <span>Actualiser</span>
            </button>
        </div> -->
    </div>
</div>