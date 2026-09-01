<link rel="stylesheet" href="{{ asset('css/verification-email-modal.css') }}">
<div class="modal fade" id="verifyModal" data-verify-url="{{ $verifyUrl ?? route('register.verify.email') }}" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content verify-modal">
            <div class="modal-body verify-body">

                <div class="verify-header">
                    <h5 class="verify-title" id="verifyModalLabel">Vérifie ton adresse e-mail</h5>
                    <p class="verify-subtitle">Code envoyé à <strong id="conditions-recap">ton adresse</strong>.</p>
                </div>

                <div class="otp-row" id="otp-row">
                    <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-box" autocomplete="one-time-code" aria-label="Chiffre 1">
                    <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-box" aria-label="Chiffre 2">
                    <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-box" aria-label="Chiffre 3">
                    <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-box" aria-label="Chiffre 4">
                    <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-box" aria-label="Chiffre 5">
                    <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-box" aria-label="Chiffre 6">
                </div>

                <div class="verify-result" id="verify-result" hidden>
                    <div class="verify-icon" id="verify-icon"></div>
                    <p class="verify-message" id="verify-message"></p>
                </div>

                <button type="button" class="btn btn-connect w-100" id="verify-action-btn" hidden></button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/verification-email-modal.js') }}" defer></script>
