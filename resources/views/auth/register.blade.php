@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/styleCREAR.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMf0c3Q2d/IOHpmYBBT6gbhOhS0B37F4l59Vj8" crossorigin="anonymous">
</head>
<div class="container">
    <div class="left-section">
        <div class="logo">
            <img src="{{ asset('img/LOGO-DATATHON.png') }}" alt="Sin Límites">
        </div>
        <form method="POST" action="{{ route('register') }}" class="register-form" id="register-form">
        @csrf

            <div class="form-group mb-3">
                <label for="document-type">{{ __('Tipo de documento:') }}</label>
                <select id="document-type" name="document_type" class="form-control @error('document_type') is-invalid @enderror" readonly>
                    <option value="DNI" selected>DNI</option>
                    <option value="CARNET">CARNET DE EXTRANJERÍA</option>
                </select>
                @error('document_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="document-number">{{ __('Número de documento:') }}</label>
                <div class="input-group">
                    <input type="number" id="document-number" name="document_number" class="form-control @error('document_number') is-invalid @enderror" maxlength="8" min="0" required oninput="this.value = this.value.slice(0, 8);">
                    @error('document_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-group-append">
                        <button type="button" class="btn btn-secondary" onclick="fetchData()">Consultar</button>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
    <label for="verification-digit">
        {{ __('Dígito Verificador:') }}
        <a href="https://www.gob.pe/13432-encontrar-digito-verificador-en-el-dni" target="_blank" title="¿Qué es el dígito verificador?" style="margin-left: 5px;">
            <img src="https://img.icons8.com/ios-filled/20/007BFF/info.png" alt="Información" style="vertical-align: middle;">
        </a>
    </label>
    <div class="input-group">
        <input type="number" id="verification-digit" name="verification_digit" class="form-control @error('verification_digit') is-invalid @enderror" maxlength="1" min="0" required oninput="this.value = this.value.slice(0, 1);">
    </div>
    @error('verification_digit')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


            <div class="form-group mb-3">
                <label for="name">{{ __('Nombre Usuario:') }}</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="first-name">{{ __('Nombre:') }}</label>
                <input type="text" id="first-name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" readonly>
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="last-name-paternal">{{ __('Apellido Paterno:') }}</label>
                <input type="text" id="last-name-paternal" name="last_name_paternal" class="form-control @error('last_name_paternal') is-invalid @enderror" value="{{ old('last_name_paternal') }}" readonly>
                @error('last_name_paternal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="last-name-maternal">{{ __('Apellido Materno:') }}</label>
                <input type="text" id="last-name-maternal" name="last_name_maternal" class="form-control @error('last_name_maternal') is-invalid @enderror" value="{{ old('last_name_maternal') }}" readonly>
                @error('last_name_maternal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="birth-date">{{ __('Fecha de nacimiento:') }}</label>
                <input type="date" id="birth-date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" >
                @error('birth_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="nationality">{{ __('Nacionalidad:') }}</label>
                <input type="text" id="nationality" name="nationality" value="Perú" class="form-control @error('nationality') is-invalid @enderror" readonly>
                @error('nationality')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="gender">{{ __('Género:') }}</label>
                <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" onchange="toggleOtherInput()">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div id="other-gender" style="display: none;">
                    <label for="other-gender-input">{{ __('Especificar:') }}</label>
                    <input type="text" id="other-gender-input" name="other_gender" class="form-control">
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="email">{{ __('Correo Electrónico:') }}</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password">{{ __('Contraseña:') }}</label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password-confirm">{{ __('Confirmar Contraseña:') }}</label>
                <input type="password" id="password-confirm" name="password_confirmation" class="form-control" required>
            </div>

            <div class="button-group">
                <button type="button" class="login-button">LOGIN</button>
                <button type="submit" class="create-account-button">{{ __('CREAR CUENTA') }}</button>
            </div>
        </form>
    </div>

    <div class="right-section"></div>
</div>

<script>
    document.getElementById('register-form').addEventListener('submit', function(e) {

        const documentNumber = document.getElementById('document-number').value;
        const verificationDigit = document.getElementById('verification-digit').value;

        // Check lengths
        if (documentNumber.length !== 8) {
            alert('El número de documento debe tener exactamente 8 dígitos.');
            return;
        }
        if (verificationDigit.length !== 1) {
            alert('El dígito verificador debe tener exactamente 1 dígito.');
            return;
        }

        fetch(`/api/consulta-dni?numero=${documentNumber}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.digitoVerificador !== verificationDigit) {
                        Swal.fire({
                            title: 'Error',
                            text: 'El dígito verificador es incorrecto. Por favor, verifíquelo.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                        return;
                    }

                    this.submit();
                } else {
                    const errorMessage = data.message || 'No se encontraron datos.';
                    Swal.fire({
                        title: 'Error',
                        text: errorMessage,
                        icon: 'error',  
                        confirmButtonText: 'Aceptar'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al consultar la API.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            });
    });

    function fetchData() {
        const documentNumber = document.getElementById('document-number').value;

        if (!documentNumber) {
            alert('Por favor, ingrese un número de documento.');
            return;
        }

        fetch(`/api/consulta-dni?numero=${documentNumber}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('first-name').value = data.nombres;
                    document.getElementById('last-name-paternal').value = data.apellidoPaterno;
                    document.getElementById('last-name-maternal').value = data.apellidoMaterno;
                } else {
                    const errorMessage = data.message || 'No se encontraron datos.';
                    alert('Error: ' + errorMessage);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al consultar la API.');
            });
    }

    function toggleOtherInput() {
        const genderSelect = document.getElementById('gender');
        const otherInput = document.getElementById('other-gender');

        if (genderSelect.value === 'Otro') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
            document.getElementById('other-gender-input').value = ''; // Limpia el campo si no es "Otro"
        }
    }
</script>

@endsection
