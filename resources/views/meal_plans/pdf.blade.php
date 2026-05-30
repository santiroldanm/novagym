<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Plan Nutricional NovaGym - {{ $mealPlan->name }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1a1a1a;
            padding: 40px;
            line-height: 1.6;
        }
        .header {
            border-bottom: 2px solid #00f0ff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: 800;
            color: #030712;
            letter-spacing: -1px;
            display: inline-block;
        }
        .logo span { color: #00f0ff; }
        .doc-type {
            font-size: 12px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            float: right;
            margin-top: 8px;
        }
        .title {
            font-size: 28px;
            margin: 0 0 10px 0;
            color: #030712;
        }
        .meta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .meta-table td {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
        }
        .meta-table td.label {
            font-weight: bold;
            background-color: #f8fafc;
            width: 25%;
        }
        .macros-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .macros-table th {
            background-color: #0f172a;
            color: white;
            padding: 10px 15px;
            text-align: center;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .macros-table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #e2e8f0;
            font-size: 18px;
            font-weight: bold;
        }
        .macros-table td small {
            font-size: 11px;
            font-weight: normal;
            color: #64748b;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 15px;
            color: #0f172a;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }
        .content {
            font-size: 14px;
            white-space: pre-wrap;
            background-color: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        .footer {
            margin-top: 50px;
            font-size: 11px;
            text-align: center;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">NOVA<span>GYM</span></div>
        <div class="doc-type">Plan Nutricional Oficial</div>
        <div style="clear: both;"></div>
    </div>

    <h1 class="title">{{ $mealPlan->name }}</h1>

    <table class="meta-table">
        <tr>
            <td class="label">Atleta / Socio</td>
            <td>{{ $mealPlan->client ? $mealPlan->client->name : 'Atleta de Alto Rendimiento' }}</td>
            <td class="label">Instructor a Cargo</td>
            <td>{{ $mealPlan->instructor ? $mealPlan->instructor->name : 'Staff NovaGym' }}</td>
        </tr>
        <tr>
            <td class="label">Fecha de Generación</td>
            <td colspan="3">{{ now()->translatedFormat('d \d\e F \d\e Y') }}</td>
        </tr>
    </table>

    <div class="section-title">Distribución de Macronutrientes</div>
    <table class="macros-table">
        <thead>
            <tr>
                <th>Calorías</th>
                <th>Proteínas</th>
                <th>Carbohidratos</th>
                <th>Grasas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $mealPlan->calories ?? '—' }} <small>kcal</small></td>
                <td>{{ $mealPlan->proteins_g ?? '—' }} <small>g</small></td>
                <td>{{ $mealPlan->carbs_g ?? '—' }} <small>g</small></td>
                <td>{{ $mealPlan->fats_g ?? '—' }} <small>g</small></td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">Detalle del Plan Alimentario</div>
    <div class="content">{{ $mealPlan->description }}</div>

    <div class="footer">
        © {{ now()->year }} NOVAGYM Systems. Diseñado para coaching nutricional de alto rendimiento.
    </div>
</body>
</html>
