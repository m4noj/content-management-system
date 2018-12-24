ClassicEditor
	.create(document.querySelector('#editor'), {
		toolbar: [
		'heading', '|', 'bold', 'italic', 'blockQuote', 'bulletedList', 'numberedList', 'link', 'alignment:left', 'alignment:right', 'alignment:center', 'alignment:justify', 'imageUpload', 'mediaEmbed', 'insertTable', 'undo', 'redo'
	]
	})
	.then(editor => {
		window.editor = editor;
	})
	.catch(err => {
		console.log(err.stack);
	})