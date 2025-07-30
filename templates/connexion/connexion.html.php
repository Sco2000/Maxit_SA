<?php $errors = $this->session->get('errors'); $this->session->unset('errors'); ?>

<div class="min-h-screen w-full flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header with gradient -->
            <div class="bg-gradient-to-r from-orange-500 to-red-500 p-8 text-center">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-white/20 p-4 rounded-full">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">MAXITSA</h1>
                <p class="text-orange-100">Bienvenu sur MAXITSA</p>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <!-- Form -->
                <form class="space-y-6" method="post" action="<?php $url ?>login">
                    <!-- Login Field -->
                    <div class="space-y-2">
                        <label for="login" class="block text-sm font-semibold text-slate-700 uppercase tracking-wide">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Login</span>
                            </div>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input 
                                name="login"
                                type="text" 
                                class="w-full pl-10 pr-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 bg-slate-50 hover:bg-white focus:bg-white placeholder-slate-400"
                                placeholder="Entrez votre login"
                            >
                        </div>
                        <?php if (isset($errors['login'])): ?>
                            <div class="flex items-center space-x-2 text-red-600">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm font-medium"><?php echo $errors['login']; ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-slate-700 uppercase tracking-wide">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <span>Mot de passe</span>
                            </div>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                name="password"
                                type="password" 
                                class="w-full pl-10 pr-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 bg-slate-50 hover:bg-white focus:bg-white placeholder-slate-400"
                                placeholder="Entrez votre mot de passe"
                            >
                        </div>
                        <?php if (isset($errors['password'])): ?>
                            <div class="flex items-center space-x-2 text-red-600">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm font-medium"><?php echo $errors['password']; ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button
                            type="submit" 
                            class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold py-3 px-6 rounded-xl hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Se Connecter</span>
                        </button>
                    </div>
                </form>
                
                <div class="p-3">
                    <div>
                        <h2>Comptes Test 1</h2>
                        <p>login: ousmane</p>
                        <p>password: ousmane00</p>
                        <h2>Comptes Test 2</h2>
                        <p>login: aminata</p>
                        <p>password: aminata00</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-slate-500">ou</span>
                        </div>
                    </div>
                    <div class="mt-6">
                        <p class="text-slate-600 text-sm">
                            Pas encore de compte? 
                        </p>
                        <a 
                            href="<?php $url ?>charger_form_carte_indentite" 
                            class="inline-flex items-center mt-2 text-orange-600 hover:text-orange-700 font-semibold transition-colors duration-200 space-x-1"
                        >
                            <span>Créer un compte</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    function validateForm(event) {
        event.preventDefault(); // bloque l'envoi du formulaire
        fetch("http://localhost:8000/CNI001")
            .then(response => response.json())
            .then(data => {
                console.log("Client récupéré :", data);
                // tu peux débloquer l'envoi ici si tu veux
                // event.target.submit();
            })
            .catch(error => {
                console.error("Erreur :", error);
            });

        return false; // bloque encore l'envoi par sécurité
    }
</script> -->