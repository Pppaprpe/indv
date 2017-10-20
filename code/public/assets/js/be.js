$('#toggle').click(function() {
	$('.ui.sidebar')
	.sidebar({
		dimPage: esfalse,
		closable: false,
		transition: 'push'
	})
	.sidebar('toggle');
});

$('#sticky')
  .sticky()
;

