import sys
import os
import zipfile
import xml.etree.ElementTree as ET

from pypdf import PdfReader

# Configure standard output to use UTF-8
if hasattr(sys.stdout, 'reconfigure'):
    sys.stdout.reconfigure(encoding='utf-8')

def docx_to_text(path):
    try:
        with zipfile.ZipFile(path) as docx:
            xml_content = docx.read('word/document.xml')
            root = ET.fromstring(xml_content)
            paragraphs = []
            for para in root.iter('{http://schemas.openxmlformats.org/wordprocessingml/2006/main}p'):
                texts = [node.text for node in para.iter('{http://schemas.openxmlformats.org/wordprocessingml/2006/main}t') if node.text]
                if texts:
                    paragraphs.append(''.join(texts))
            return '\n'.join(paragraphs)
    except Exception as e:
        return f"Error parsing DOCX: {e}"

def pdf_to_text(path):
    try:
        reader = PdfReader(path)
        text = ""
        for page in reader.pages:
            t = page.extract_text()
            if t:
                text += t + "\n"
        return text
    except Exception as e:
        return f"Error parsing PDF: {e}"

def main():
    if len(sys.argv) < 2:
        print("Usage: python parse_resume.py <path_to_file>")
        sys.exit(1)
        
    path = sys.argv[1]
    if not os.path.exists(path):
        print(f"File not found: {path}")
        sys.exit(1)
        
    ext = os.path.splitext(path)[1].lower()
    if ext == '.pdf':
        print(pdf_to_text(path))
    elif ext == '.docx':
        print(docx_to_text(path))
    else:
        # Simple fallback for text files
        try:
            with open(path, 'r', encoding='utf-8', errors='ignore') as f:
                print(f.read())
        except Exception as e:
            print(f"Unsupported file format or error: {e}")

if __name__ == '__main__':
    main()
