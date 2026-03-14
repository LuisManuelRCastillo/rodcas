<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Factura — RODCAS</title>
    <style>
        :root { --brand: #dc6336; --brand-dark: #b84e27; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f3f4f6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
        }

        .logo-wrap { text-align: center; margin-bottom: 1.5rem; }
        .logo-wrap img { height: 56px; object-fit: contain; }

        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,.09);
            padding: 2rem 1.75rem;
            width: 100%;
            max-width: 480px;
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: .25rem;
        }
        .card-sub {
            font-size: .82rem;
            color: #6b7280;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1.5px solid #6ee7b7;
            color: #065f46;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            font-size: .9rem;
            text-align: center;
            line-height: 1.6;
        }
        .alert-success strong { display: block; font-size: 1rem; margin-bottom: .25rem; }

        .field { margin-bottom: 1.1rem; }
        .field label {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: .35rem;
        }
        .field label span { color: var(--brand); }
        .field input, .field select {
            width: 100%;
            padding: .6rem .85rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 9px;
            font-size: .9rem;
            color: #111827;
            outline: none;
            transition: border-color .2s;
            background: #fff;
        }
        .field input:focus, .field select:focus { border-color: var(--brand); }
        .field .error { font-size: .76rem; color: #dc2626; margin-top: .3rem; }

        .row2 { display: grid; grid-template-columns: 1fr 1fr; gap: .85rem; }
        @media(max-width: 420px) { .row2 { grid-template-columns: 1fr; } }

        .divider {
            height: 1px;
            background: #f3f4f6;
            margin: 1.25rem 0;
        }

        .btn-submit {
            width: 100%;
            padding: .75rem;
            background: var(--brand);
            color: #fff;
            border: none;
            border-radius: 9px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s;
        }
        .btn-submit:hover { background: var(--brand-dark); }

        .footer-note {
            margin-top: 1.25rem;
            text-align: center;
            font-size: .75rem;
            color: #9ca3af;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <div class="logo-wrap">
        <img src="{{ asset('assets/img/logoSF.png') }}" alt="RODCAS Ferretería">
    </div>

    <div class="card">
        <div class="card-title">Solicitud de Factura</div>
        <div class="card-sub">
            Ingresa tus datos fiscales y nos pondremos en contacto contigo una vez que tu factura esté lista.
        </div>

        @if(session('success'))
            <div class="alert-success">
                <strong>¡Solicitud enviada!</strong>
                Recibimos tus datos. Te enviaremos la factura a <strong>{{ old('email') }}</strong> en breve.
            </div>
        @else

        <form method="POST" action="{{ route('factura.store') }}">
            @csrf

            <div class="row2">
                <div class="field">
                    <label>RFC <span>*</span></label>
                    <input type="text" name="rfc" value="{{ old('rfc') }}"
                           placeholder="XAXX010101000" maxlength="13" style="text-transform:uppercase">
                    @error('rfc') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label>Código Postal <span>*</span></label>
                    <input type="text" name="codigo_postal" value="{{ old('codigo_postal') }}"
                           placeholder="64000" maxlength="5" inputmode="numeric">
                    @error('codigo_postal') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="field">
                <label>Nombre / Razón Social <span>*</span></label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                       placeholder="Ej. Juan Pérez García">
                @error('nombre') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label>Régimen Fiscal <span>*</span></label>
                <select name="regimen_fiscal">
                    <option value="">— Selecciona —</option>
                    <option value="601 - General de Ley Personas Morales" {{ old('regimen_fiscal') == '601 - General de Ley Personas Morales' ? 'selected' : '' }}>601 - General de Ley Personas Morales</option>
                    <option value="603 - Personas Morales con Fines no Lucrativos" {{ old('regimen_fiscal') == '603 - Personas Morales con Fines no Lucrativos' ? 'selected' : '' }}>603 - Personas Morales con Fines no Lucrativos</option>
                    <option value="605 - Sueldos y Salarios" {{ old('regimen_fiscal') == '605 - Sueldos y Salarios' ? 'selected' : '' }}>605 - Sueldos y Salarios</option>
                    <option value="606 - Arrendamiento" {{ old('regimen_fiscal') == '606 - Arrendamiento' ? 'selected' : '' }}>606 - Arrendamiento</option>
                    <option value="607 - Enajenación o Adquisición de Bienes" {{ old('regimen_fiscal') == '607 - Enajenación o Adquisición de Bienes' ? 'selected' : '' }}>607 - Enajenación o Adquisición de Bienes</option>
                    <option value="608 - Demás ingresos" {{ old('regimen_fiscal') == '608 - Demás ingresos' ? 'selected' : '' }}>608 - Demás ingresos</option>
                    <option value="610 - Residentes en el Extranjero" {{ old('regimen_fiscal') == '610 - Residentes en el Extranjero' ? 'selected' : '' }}>610 - Residentes en el Extranjero</option>
                    <option value="611 - Ingresos por Dividendos" {{ old('regimen_fiscal') == '611 - Ingresos por Dividendos' ? 'selected' : '' }}>611 - Ingresos por Dividendos</option>
                    <option value="612 - Actividades Empresariales y Profesionales" {{ old('regimen_fiscal') == '612 - Actividades Empresariales y Profesionales' ? 'selected' : '' }}>612 - Actividades Empresariales y Profesionales</option>
                    <option value="614 - Ingresos por Intereses" {{ old('regimen_fiscal') == '614 - Ingresos por Intereses' ? 'selected' : '' }}>614 - Ingresos por Intereses</option>
                    <option value="616 - Sin obligaciones fiscales" {{ old('regimen_fiscal') == '616 - Sin obligaciones fiscales' ? 'selected' : '' }}>616 - Sin obligaciones fiscales</option>
                    <option value="620 - Sociedades Cooperativas de Producción" {{ old('regimen_fiscal') == '620 - Sociedades Cooperativas de Producción' ? 'selected' : '' }}>620 - Sociedades Cooperativas de Producción</option>
                    <option value="621 - Incorporación Fiscal" {{ old('regimen_fiscal') == '621 - Incorporación Fiscal' ? 'selected' : '' }}>621 - Incorporación Fiscal</option>
                    <option value="622 - Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras" {{ old('regimen_fiscal') == '622 - Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras' ? 'selected' : '' }}>622 - Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras</option>
                    <option value="623 - Opcional para Grupos de Sociedades" {{ old('regimen_fiscal') == '623 - Opcional para Grupos de Sociedades' ? 'selected' : '' }}>623 - Opcional para Grupos de Sociedades</option>
                    <option value="624 - Coordinados" {{ old('regimen_fiscal') == '624 - Coordinados' ? 'selected' : '' }}>624 - Coordinados</option>
                    <option value="625 - Plataformas Tecnológicas" {{ old('regimen_fiscal') == '625 - Plataformas Tecnológicas' ? 'selected' : '' }}>625 - Plataformas Tecnológicas</option>
                    <option value="626 - Régimen Simplificado de Confianza (RESICO)" {{ old('regimen_fiscal') == '626 - Régimen Simplificado de Confianza (RESICO)' ? 'selected' : '' }}>626 - Régimen Simplificado de Confianza (RESICO)</option>
                </select>
                @error('regimen_fiscal') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label>Uso de CFDI <span>*</span></label>
                <select name="uso_cfdi">
                    <option value="">— Selecciona —</option>
                    <option value="G01 - Adquisición de mercancias" {{ old('uso_cfdi') == 'G01 - Adquisición de mercancias' ? 'selected' : '' }}>G01 - Adquisición de mercancias</option>
                    <option value="G02 - Devoluciones, descuentos o bonificaciones" {{ old('uso_cfdi') == 'G02 - Devoluciones, descuentos o bonificaciones' ? 'selected' : '' }}>G02 - Devoluciones, descuentos o bonificaciones</option>
                    <option value="G03 - Gastos en general" {{ old('uso_cfdi') == 'G03 - Gastos en general' ? 'selected' : '' }}>G03 - Gastos en general</option>
                    <option value="I01 - Construcciones" {{ old('uso_cfdi') == 'I01 - Construcciones' ? 'selected' : '' }}>I01 - Construcciones</option>
                    <option value="I02 - Mobiliario y equipo de oficina" {{ old('uso_cfdi') == 'I02 - Mobiliario y equipo de oficina' ? 'selected' : '' }}>I02 - Mobiliario y equipo de oficina</option>
                    <option value="I03 - Equipo de transporte" {{ old('uso_cfdi') == 'I03 - Equipo de transporte' ? 'selected' : '' }}>I03 - Equipo de transporte</option>
                    <option value="I04 - Equipo de cómputo y accesorios" {{ old('uso_cfdi') == 'I04 - Equipo de cómputo y accesorios' ? 'selected' : '' }}>I04 - Equipo de cómputo y accesorios</option>
                    <option value="I05 - Dados, troqueles, moldes, matrices y herramental" {{ old('uso_cfdi') == 'I05 - Dados, troqueles, moldes, matrices y herramental' ? 'selected' : '' }}>I05 - Dados, troqueles, moldes, matrices y herramental</option>
                    <option value="I06 - Comunicaciones telefónicas" {{ old('uso_cfdi') == 'I06 - Comunicaciones telefónicas' ? 'selected' : '' }}>I06 - Comunicaciones telefónicas</option>
                    <option value="I08 - Otra maquinaria y equipo" {{ old('uso_cfdi') == 'I08 - Otra maquinaria y equipo' ? 'selected' : '' }}>I08 - Otra maquinaria y equipo</option>
                    <option value="S01 - Sin efectos fiscales" {{ old('uso_cfdi') == 'S01 - Sin efectos fiscales' ? 'selected' : '' }}>S01 - Sin efectos fiscales</option>
                    <option value="CP01 - Pagos" {{ old('uso_cfdi') == 'CP01 - Pagos' ? 'selected' : '' }}>CP01 - Pagos</option>
                    <option value="CN01 - Nómina" {{ old('uso_cfdi') == 'CN01 - Nómina' ? 'selected' : '' }}>CN01 - Nómina</option>
                </select>
                @error('uso_cfdi') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label>Correo Electrónico <span>*</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="tucorreo@ejemplo.com" inputmode="email">
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="divider"></div>

            <button type="submit" class="btn-submit">Enviar solicitud</button>
        </form>

        @endif
    </div>

    <div class="footer-note">
        RODCAS Ferretería &nbsp;·&nbsp; Solicitud de factura electrónica<br>
        Una vez procesada, recibirás tu CFDI por correo.
    </div>

</body>
</html>
