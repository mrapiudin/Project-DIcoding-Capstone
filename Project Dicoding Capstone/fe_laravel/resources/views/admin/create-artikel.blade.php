@extends('template.sidebar')

@section('title', 'Create Artikel - HealthSpace Admin')

@push('styles')
<style>
/* Create Artikel Styles */
.create-header {
    background: white;
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-left: 4px solid #10b981;
}

.create-header h1 {
    font-size: 28px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 8px;
}

.create-header p {
    color: #6b7280;
    font-size: 16px;
}

.form-container {
    background: white;
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 24px;
}

.form-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

.form-input {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 16px;
    color: #111827;
    transition: all 0.2s ease;
    font-family: inherit;
}

.form-input:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.form-textarea {
    width: 100%;
    min-height: 120px;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 16px;
    color: #111827;
    resize: vertical;
    font-family: inherit;
    line-height: 1.5;
    transition: all 0.2s ease;
}

.form-textarea:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.form-select {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 16px;
    color: #111827;
    background-color: white;
    transition: all 0.2s ease;
    font-family: inherit;
}

.form-select:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.file-upload {
    position: relative;
    display: inline-block;
    width: 100%;
}

.file-upload input[type=file] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-upload-label {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 24px;
    border: 2px dashed #d1d5db;
    border-radius: 8px;
    background: #f9fafb;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.2s ease;
}

.file-upload-label:hover {
    border-color: #10b981;
    background: #f0fdf4;
    color: #059669;
}

.btn-group {
    display: flex;
    gap: 16px;
    justify-content: flex-end;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid #e5e7eb;
}

.btn {
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.2s ease;
}

.btn-primary {
    background: #10b981;
    color: white;
    border-color: #10b981;
}

.btn-primary:hover {
    background: #059669;
    border-color: #059669;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
}

.btn-secondary {
    background: white;
    color: #6b7280;
    border-color: #d1d5db;
}

.btn-secondary:hover {
    background: #f9fafb;
    color: #374151;
    border-color: #9ca3af;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .btn-group {
        flex-direction: column;
    }
}

.editor-toolbar {
    display: flex;
    gap: 8px;
    margin-bottom: 8px;
    padding: 8px;
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-bottom: none;
    border-radius: 8px 8px 0 0;
}

.toolbar-btn {
    padding: 6px 10px;
    background: white;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    cursor: pointer;
    transition: all 0.2s ease;
}

.toolbar-btn:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
}

.content-editor {
    border-radius: 0 0 8px 8px;
    border-top: none;
    min-height: 300px;
}
</style>
@endpush

@section('content')
<div class="create-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1>Buat Artikel Baru</h1>
            <p>Tulis dan publikasikan artikel kesehatan untuk pengguna HealthSpace</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            ← Kembali ke Dashboard
        </a>
    </div>
</div>

<div class="form-container">
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Basic Information -->
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label" for="title">Judul Artikel *</label>
                <input type="text" id="title" name="title" class="form-input" 
                       placeholder="Masukkan judul artikel..." required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="category">Kategori *</label>
                <select id="category" name="category" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="olahraga">Olahraga & Fitness</option>
                    <option value="nutrisi">Nutrisi & Diet</option>
                    <option value="mental-health">Kesehatan Mental</option>
                    <option value="lifestyle">Gaya Hidup Sehat</option>
                    <option value="medical">Informasi Medis</option>
                    <option value="tips">Tips & Trik</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="excerpt">Ringkasan Artikel *</label>
            <textarea id="excerpt" name="excerpt" class="form-textarea" 
                      placeholder="Tulis ringkasan singkat tentang artikel ini..." 
                      rows="3" required></textarea>
        </div>

        <!-- Featured Image -->
        <div class="form-group">
            <label class="form-label">Gambar Utama</label>
            <div class="file-upload">
                <input type="file" name="featured_image" accept="image/*">
                <div class="file-upload-label">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 8L12 3L7 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 3V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Pilih gambar atau drag & drop di sini</span>
                </div>
            </div>
            <p style="font-size: 14px; color: #6b7280; margin-top: 8px;">
                Format: JPG, PNG, GIF (Max: 2MB)
            </p>
        </div>

        <!-- Content Editor -->
        <div class="form-group">
            <label class="form-label" for="content">Konten Artikel *</label>
            <div class="editor-toolbar">
                <button type="button" class="toolbar-btn" onclick="formatText('bold')"><strong>B</strong></button>
                <button type="button" class="toolbar-btn" onclick="formatText('italic')"><em>I</em></button>
                <button type="button" class="toolbar-btn" onclick="formatText('underline')"><u>U</u></button>
                <button type="button" class="toolbar-btn" onclick="insertList()">• List</button>
                <button type="button" class="toolbar-btn" onclick="insertLink()">🔗 Link</button>
            </div>
            <textarea id="content" name="content" class="form-textarea content-editor" 
                      placeholder="Tulis konten artikel di sini... Gunakan toolbar di atas untuk formatting." 
                      required></textarea>
        </div>

        <!-- Additional Settings -->
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label" for="tags">Tags</label>
                <input type="text" id="tags" name="tags" class="form-input" 
                       placeholder="olahraga, kesehatan, tips (pisahkan dengan koma)">
            </div>
            
            <div class="form-group">
                <label class="form-label" for="status">Status Publikasi *</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="draft">Draft</option>
                    <option value="published">Publikasikan Sekarang</option>
                    <option value="scheduled">Jadwalkan</option>
                </select>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="btn-group">
            <button type="button" class="btn btn-secondary" onclick="saveDraft()">
                📄 Simpan sebagai Draft
            </button>
            <button type="submit" class="btn btn-primary">
                🚀 Publikasikan Artikel
            </button>
        </div>
    </form>
</div>

<script>
function formatText(command) {
    document.execCommand(command, false, null);
    document.getElementById('content').focus();
}

function insertList() {
    const textarea = document.getElementById('content');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;
    const before = text.substring(0, start);
    const selection = text.substring(start, end);
    const after = text.substring(end);
    
    textarea.value = before + '• ' + selection + after;
    textarea.focus();
}

function insertLink() {
    const url = prompt('Masukkan URL:');
    if (url) {
        const text = prompt('Masukkan teks link:') || url;
        const textarea = document.getElementById('content');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const before = textarea.value.substring(0, start);
        const after = textarea.value.substring(end);
        
        textarea.value = before + `[${text}](${url})` + after;
        textarea.focus();
    }
}

function saveDraft() {
    // Logic for saving as draft
    alert('Artikel disimpan sebagai draft');
}

// File upload preview
document.querySelector('input[type="file"]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const label = document.querySelector('.file-upload-label span');
        label.textContent = file.name;
    }
});
</script>
@endsection