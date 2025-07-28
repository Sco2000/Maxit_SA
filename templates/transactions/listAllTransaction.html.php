<?php $compte=$this->session->get('compte'); extract($compte);?>
<?php $pagination=$this->session->get('all_transactions'); extract($pagination);?>

<div class="min-h-screen z-0 absolute right-0 w-[1500px] bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="w-full flex-1 flex flex-col p-6 mx-auto">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-slate-200">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <!-- Balance Card -->
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl p-6 shadow-lg">
                            <?php if (isset($solde)): ?>
                                <div class="text-white">
                                    <p class="text-sm font-medium opacity-90 mb-1">Solde disponible</p>
                                    <h2 class="text-3xl font-bold"><?= number_format($solde, 0, ',', ' ') ?> <span class="text-lg">FCFA</span></h2>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-400 rounded-full border-4 border-white animate-pulse"></div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800 mb-2">Toutes les Transactions</h1>
                        <p class="text-slate-600">Historique complet de vos opérations</p>
                    </div>
                </div>
                
                <!-- Filters Section -->
                <div class="flex items-center space-x-4 flex-wrap">
                    <div class="relative">
                        <select class="bg-white border-2 border-slate-300 rounded-xl px-6 py-3 pr-10 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 appearance-none cursor-pointer shadow-sm hover:shadow-md">
                            <option>Filtrer par type</option>
                            <option>Tous</option>
                            <option>Dépôt</option>
                            <option>Retrait</option>
                            <option>Paiement</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <input type="date" class="bg-white border-2 border-slate-300 rounded-xl px-6 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>

                    <button class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 transform hover:scale-105 shadow-lg flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>Filtrer</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-slate-200">
            <div class="bg-gradient-to-r from-orange-500 to-red-500 p-6">
                <h3 class="text-xl font-bold text-white">Historique complet des transactions</h3>
                <p class="text-orange-100 mt-1">Toutes vos opérations financières</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="p-4 text-left font-semibold text-slate-700">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Date</span>
                                </div>
                            </th>
                            <th class="p-4 text-left font-semibold text-slate-700">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <span>Type</span>
                                </div>
                            </th>
                            <th class="p-4 text-left font-semibold text-slate-700">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    <span>Montant</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $index => $transaction): ?>
                            <?php 
                                $type = $transaction->getTypeTransaction()->value;
                                $colorClass = match ($type) {
                                    'depot' => 'text-emerald-600 bg-emerald-50',
                                    'retrait' => 'text-red-600 bg-red-50',
                                    'paiement' => 'text-blue-600 bg-blue-50',
                                    default => 'text-slate-600 bg-slate-50',
                                };
                                $icon = match ($type) {
                                    'depot' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>',
                                    'retrait' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>',
                                    'paiement' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>',
                                    default => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                                };
                            ?>
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors duration-200 <?= $index % 2 == 0 ? 'bg-white' : 'bg-slate-25' ?>">
                                <td class="p-4">
                                    <div class="flex flex-col">
                                        <div class="font-semibold text-slate-800"><?= explode(' ', $transaction->getDate())[0] ?></div>
                                        <div class="text-sm text-slate-500"><?= explode('.', explode(' ', $transaction->getDate())[1])[0] ?></div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?= $colorClass ?>">
                                            <?= $icon ?>
                                            <span class="ml-1 capitalize"><?= $type ?></span>
                                        </span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-slate-800">
                                        <?= number_format($transaction->getMontant(), 0, ',', ' ') ?> 
                                        <span class="text-sm text-slate-500 font-normal">FCFA</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2 mt-8">
            <?php $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; ?>
            
            <!-- Previous Button -->
            <?php if ($currentPage > 1): ?>
                <a href="<?php $url ?>?page=<?= $currentPage - 1 ?>" class="flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Précédent
                </a>
            <?php endif; ?>
            
            <!-- Page Numbers -->
            <?php for ($i = 1; $i <= $pages; $i++): 
                $isActive = $i == $currentPage;
                $baseClass = 'px-4 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105';
                $activeClass = $isActive ? 'bg-gradient-to-r from-orange-500 to-red-600 text-white shadow-lg' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-300';
            ?>
                <a href="<?php $url ?>?page=<?= $i ?>" class="<?= $baseClass ?> <?= $activeClass ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
            
            <!-- Next Button -->
            <?php if ($currentPage < $pages): ?>
                <a href="<?php $url ?>?page=<?= $currentPage + 1 ?>" class="flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50 transition-colors duration-200">
                    Suivant
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>