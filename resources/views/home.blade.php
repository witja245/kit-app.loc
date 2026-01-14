<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кит Финанс Брокер - Генератор DOCX документов</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #311641 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            min-height: 100vh;
        }

        .header {
            grid-column: 1 / -1;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.3);
            color: #667eea;
            backdrop-filter: blur(10px);
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        .sidebar h3 {
            color: #4a5568;
            margin-bottom: 25px;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .template-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            border: 2px solid transparent;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }

        .template-item:hover,
        .template-item.active {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .template-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .template-info h4 {
            color: #2d3748;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .template-info p {
            color: #718096;
            font-size: 0.9rem;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .upload-area {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 3px dashed rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            text-align: center;
        }

        .upload-area.dragover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.02);
        }

        .upload-icon {
            font-size: 4rem;
            color: #cbd5e0;
            margin-bottom: 20px;
        }

        .upload-area h2 {
            color: #2d3748;
            margin-bottom: 15px;
            font-size: 1.8rem;
        }

        .upload-area p {
            color: #718096;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 30px;
        }

        #file-input {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .preview-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .preview-section h3 {
            color: #2d3748;
            margin-bottom: 30px;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .variables-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .variable-group {
            background: rgba(248, 250, 252, 0.8);
            padding: 25px;
            border-radius: 16px;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .variable-group h4 {
            color: #4a5568;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #4a5568;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .generate-btn {
            width: 100%;
            padding: 20px;
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .generate-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(72, 187, 120, 0.4);
        }

        .preview-area {
            background: #f7fafc;
            border-radius: 16px;
            padding: 30px;
            margin-top: 30px;
            border: 2px dashed #e2e8f0;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #718096;
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                padding: 10px;
            }

            .header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <header class="header">
        <div class="logo"><img src="/img/logo.svg" alt="Логотип" width="160" height="60"></div>
        <div class="header-actions">
            <a href="#" class="btn btn-secondary">📋 Шаблоны</a>
            <a href="#" class="btn btn-secondary">👤 Профиль</a>
            <a href="#" class="btn btn-primary">💾 Сохранить</a>
        </div>
    </header>

    <!-- Sidebar с шаблонами -->
    <aside class="sidebar">
        <h3>📁 Шаблоны документов</h3>
        <div class="template-item active">
            <div class="template-icon">📄</div>
            <div class="template-info">
                <h4>Договор поставки</h4>
                <p>dogovor.docx</p>
            </div>
        </div>
        <div class="template-item">
            <div class="template-icon">📋</div>
            <div class="template-info">
                <h4>Счет-фактура</h4>
                <p>schet.docx</p>
            </div>
        </div>
        <div class="template-item">
            <div class="template-icon">📊</div>
            <div class="template-info">
                <h4>Отчет по продажам</h4>
                <p>otchet.docx</p>
            </div>
        </div>
        <input type="file" id="template-upload" accept=".docx" style="display: none;">
        <button class="btn btn-primary" onclick="document.getElementById('template-upload').click()" style="width: 100%; margin-top: 20px;">
            ➕ Загрузить шаблон
        </button>
    </aside>

    <!-- Основной контент -->
    <main class="main-content">
        <!-- Зона загрузки DOCX -->
        <div class="upload-area" id="upload-area">
            <div class="upload-icon">📎</div>
            <h2>Загрузите DOCX шаблон</h2>
            <p>Перетащите файл .docx или нажмите для выбора</p>
            <div class="file-input-wrapper">
                <input type="file" id="file-input" accept=".docx" required>
            </div>
        </div>

        <!-- Переменные для подстановки -->
        <section class="preview-section">
            <h3>🔧 Переменные для подстановки</h3>
            <div class="variables-grid">
                <div class="variable-group">
                    <h4>👤 Данные клиента</h4>
                    <div class="form-group">
                        <label>ФИО клиента (${client_name})</label>
                        <input type="text" placeholder="Иванов Иван Иванович">
                    </div>
                    <div class="form-group">
                        <label>Email (${client_email})</label>
                        <input type="email" placeholder="ivan@example.com">
                    </div>
                    <div class="form-group">
                        <label>Телефон (${client_phone})</label>
                        <input type="text" placeholder="+7 (999) 123-45-67">
                    </div>
                </div>

                <div class="variable-group">
                    <h4>📅 Даты</h4>
                    <div class="form-group">
                        <label>Дата договора (${contract_date})</label>
                        <input type="date">
                    </div>
                    <div class="form-group">
                        <label>Дата выполнения (${due_date})</label>
                        <input type="date">
                    </div>
                </div>

                <div class="variable-group">
                    <h4>💰 Суммы</h4>
                    <div class="form-group">
                        <label>Сумма (${amount})</label>
                        <input type="number" placeholder="150000">
                    </div>
                    <div class="form-group">
                        <label>НДС (${vat})</label>
                        <input type="number" placeholder="27000">
                    </div>
                    <div class="form-group">
                        <label>Итого (${total})</label>
                        <input type="number" placeholder="177000">
                    </div>
                </div>

                <div class="variable-group">
                    <h4>📄 Детали</h4>
                    <div class="form-group">
                        <label>Номер договора (${contract_number})</label>
                        <input type="text" placeholder="Д-2026/001">
                    </div>
                    <div class="form-group">
                        <label>Комментарий (${comment})</label>
                        <textarea placeholder="Дополнительная информация..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Кнопка генерации -->
            <button class="generate-btn" onclick="generateDocument()">
                ✨ Сгенерировать DOCX документ
            </button>

            <!-- Превью результата -->
            <div class="preview-area">
                <div>
                    <div style="font-size: 3rem; margin-bottom: 20px;">📄</div>
                    <h3>Готовый документ появится здесь</h3>
                    <p>После генерации вы сможете скачать готовый DOCX файл с подставленными переменными</p>
                </div>
            </div>
        </section>
    </main>
</div>

<script>
    // Drag & Drop для загрузки
    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('file-input');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        uploadArea.classList.add('dragover');
    }

    function unhighlight(e) {
        uploadArea.classList.remove('dragover');
    }

    uploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            if (file.name.endsWith('.docx')) {
                console.log('Загружен шаблон:', file.name);
                // Здесь будет AJAX запрос на сервер для загрузки
            } else {
                alert('Пожалуйста, выберите файл .docx');
            }
        }
    }

    function generateDocument() {
        // Здесь будет AJAX запрос на сервер для генерации DOCX
        alert('✅ Документ генерируется...\n\nСкоро будет скачивание готового DOCX файла!');
    }
</script>
</body>
</html>
