<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PlantUML Online Renderer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        #editor-container { width: 100%; height: 400px; border: 1px solid #ccc; }
        .form-control { margin: 10px 0; }
    </style>
</head>
<body>
    <h1>PlantUML Editor</h1>
    <form method="post" action="convert.php">
        <div id="editor-container"></div>
        <input type="hidden" id="code" name="code">
        
        <div class="form-control">
            <label for="format">Select Format:</label>
            <select name="format" id="format">
                <option value="svg">SVG</option>
                <option value="png">PNG</option>
                <option value="txt">ASCII</option>
            </select>
        </div>

        <button type="submit" onclick="document.getElementById('code').value = editor.getValue();">
            Generate Diagram
        </button>
    </form>

    <script>
        require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs' }});
        require(['vs/editor/editor.main'], function () {
            window.editor = monaco.editor.create(document.getElementById('editor-container'), {
                value: '@startuml\nAlice -> Bob : Hello\n@enduml',
                language: 'plaintext'
            });
        });
    </script>
</body>
</html>
