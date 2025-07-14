# 🖼️ Auto Word Image Inserter 📄 with PHP + Python

Welcome to the **Auto Word Image Inserter**, a lightweight local tool to let users **upload images via drag & drop**, and automatically generate a **Microsoft Word document (`.docx`)** containing those images arranged in a **3x3 grid layout**.

> 💡 Ideal for offline systems, reporting tools, documentation templates, or field image collection.

---

## 📦 Features

✅ Drag & Drop multiple image files  
✅ Live file preview with delete option  
✅ Upload via AJAX to PHP  
✅ Backend removes old images before each upload  
✅ Automatically runs a Python script to generate a new `.docx` file  
✅ Output saved as `out.docx` + JSON summary  
✅ Works offline – No internet required  
✅ Fully compatible with legacy systems (tested on **PHP 5.6**)

---

## 🗂️ Project Structure

```
project-root/
│
├── index.html           # 🌐 Frontend drag & drop upload UI
├── uploadpic.php        # 📤 Receives and saves images, runs Python
├── strter.py            # 🐍 Python script: inserts images into Word doc
├── asl.docx             # 📄 Template Word file (base)
├── out.docx             # 📄 Final generated Word file
├── output.json          # 📊 JSON summary with image count
└── pic/                 # 🖼️ Uploaded images stored here
```

---

## 🖥️ Requirements

### ✅ PHP

- PHP **5.6 or higher**
- `exec()` must be enabled (check in `php.ini`)
- Apache/Nginx with write permissions to `pic/` and current folder

### ✅ Python

- Python **3.11 or 3.12+**
- Required packages:
  - `python-docx`
  - `Pillow`

You can install them (online) using:

```bash
pip install python-docx pillow
```

Or install offline using `.whl` files and:

```bash
pip install --no-index --find-links=. python-docx pillow
```

---

## 🚀 How It Works

1. User drops image files into the UI or selects them
2. Files get listed with "Remove" buttons
3. When **Upload** is clicked:
   - PHP deletes old images
   - PHP saves uploaded ones into `pic/`
   - PHP runs `strter.py` using Python
   - Python sorts the image files by name
   - Inserts them into `asl.docx` in a **3x3 grid per page**
   - Saves final output to `out.docx`
   - Also creates `output.json` with `image_count`
4. PHP reads the JSON and gives back:
   - ✅ Number of successfully inserted images
   - 📎 Download link for `out.docx`

---

## 🛠️ Configuration

Make sure to edit this line in `uploadpic.php` to match your Python install:

```php
$python = 'C:\Users\YOUR_USERNAME\AppData\Local\Programs\Python\Python313\python.exe';
```

Also make sure the PHP file has write access to:

- `pic/`
- `out.docx`
- `output.json`

---

## 🧪 Test It

Run in your browser:

```
http://127.0.0.1/your-folder/index.html
```

Try uploading multiple images, then download the final Word file after processing.

---

## 🔐 Notes

- Works completely **offline**, including offline pip installation
- Images with unsupported formats will be skipped
- Old images are **deleted before each upload**
- Compatible with most modern and legacy browsers

---

## 📄 Sample `output.json`

```json
{
  "image_count": 9,
  "status": "ok"
}
```

---

## 📥 Future Features (Suggestions)

- ✅ PDF generation from Word
- 🧠 OCR support (image-to-text before inserting)
- 🌍 Multi-language support (EN/FA)
- 📬 Email output file to user

---

## 👨‍💻 Author

Made with ❤️ by [Vahid](mailto:your@email.com)

---

## 🧼 License

MIT License — use it freely for personal or commercial projects.