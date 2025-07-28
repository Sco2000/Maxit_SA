document.addEventListener('DOMContentLoaded', function () {
    const paiementLink = document.getElementById('paiement-link');
    const paiementFormContainer = document.getElementById('paiement-form-container');
    const paiementForm = document.getElementById('paiement-form');
    const cancelBtn = document.getElementById('paiement-cancel');
    const compteurInput = document.getElementById('compteur');
    const montantInput = document.getElementById('montant');
    const compteurError = document.getElementById('compteur-error');
    const montantError = document.getElementById('montant-error');
    const successMsg = document.getElementById('paiement-success');
    const failMsg = document.getElementById('paiement-fail');

    paiementLink.addEventListener('click', function (e) {
        e.preventDefault();
        paiementFormContainer.classList.remove('hidden');
        successMsg.textContent = '';
        failMsg.textContent = '';
        paiementForm.reset();
        compteurError.textContent = '';
        montantError.textContent = '';
    });

    cancelBtn.addEventListener('click', function () {
        paiementFormContainer.classList.add('hidden');
    });

    // Fonction utilitaire pour afficher les erreurs
    function showError(element, message) {
        element.textContent = message;
    }
    function hideError(element) {
        element.textContent = '';
    }

    // Fonction asynchrone pour envoyer le paiement
    async function envoyerPaiement(compteur, montant) {
        try {
            const response = await fetch('https://appback-ojwv.onrender.com/achat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ compteur, montant })
            });
            return await response.json();
        } catch (error) {
            throw error;
        }
    }

    paiementForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        hideError(compteurError);
        hideError(montantError);
        successMsg.textContent = '';
        failMsg.textContent = '';

        let valid = true;
        const compteur = compteurInput.value.trim();
        const montant = montantInput.value.trim();

        // Validation JS
        if (!compteur) {
            showError(compteurError, 'Champ compteur requis');
            valid = false;
        }
        if (!montant || isNaN(montant) || Number(montant) < 100) {
            showError(montantError, 'Montant minimum: 100 FCFA');
            valid = false;
        }

        if (!valid) return;

        try {
            const data = await envoyerPaiement(compteur, montant);
            if (data.success) {
                successMsg.textContent = 'Paiement effectué avec succès!';
                paiementForm.reset();
            } else {
                failMsg.textContent = data.message || 'Erreur lors du paiement.';
            }
        } catch (error) {
            failMsg.textContent = 'Erreur réseau ou serveur.';
        }
    });
});