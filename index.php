<html>

<!-- DO NO EDIT ANYTHING TO WORK PORPELY -->
<!-- © @moaj257 | https://github.com/moaj257 -->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
	<title>JioTV LIVE</title>
	<link rel="shortcut icon" type="image/x-icon" href="https://i.ibb.co/37fVLxB/f4027915ec9335046755d489a14472f2.png">
	<meta name="robots" content="noindex" />
	<script src="https://cdn.jsdelivr.net/npm/lazysizes@5.3.2/lazysizes.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="data/css/page.css" />
</head>

<body class="bg-gray-200 text-black">
	<div class="container mx-auto px-6">
		<div id="jtvh1" class="flex items-center flex-col justify-between pb-2 pt-4 md:flex-row">
			<a href="https://github.com/moaj257" class="flex items-center justify-start pb-3 md:pb-0 text-left w-full">
				<img src="data/images/logo.png" class="h-12 w-12" alt="Logo" srcset="">
				<span class="ml-2 font-bold text-xl">Jio TV</span>
			</a>
			<div class="w-full md:w-64 flex justify-center items-center text-black bg-white py-2 px-2 rounded overflow-hidden">
				<img class="w-4 h-4" src="data/images/search.png" alt="Search" srcset="">
				<input type="search" class="outline-none w-full px-2" placeholder="Search..." name="search-inp" id="search-inp" value="">
			</div>
		</div>
		<div id="content" class="py-3">
			<div class="container">
				<div id="list" class="grid gap-4 grid-cols-2 md:grid-cols-5 lg:grid-cols-7 xl:grid-cols-9">
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	/**
	* Execute a function given a delay time
	* 
	* @param {type} func
	* @param {type} wait
	* @param {type} immediate
	* @returns {Function}
	*/
	var debounce = function (func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
					timeout = null;
					if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};

	let tvList = () => {
		$.ajax({
			url: 'ajax.php',
			data: { q: $('#search-inp').val() },
			method: 'GET',
			dataType: 'json',
			success: function(d) {
				let _result = d.result;
				let _html = "";
				$(_result).each((i, v) => {
					_html = `${_html}
								<div class="rounded overflow-hidden shadow-lg bg-gray-100 flex flex-col items-center justify-center">
									<a href="play.php?c=${v.target}" class="w-full">
										<img class="lazyload" data-src="http://jiotv.catchup.cdn.jio.com/dare_images/images/${v.logoUrl}" style="height: 120px" />
										<div class="px-6 py-4">
											<p class="font-bold text-gray-700 text-sm text-center">${v.channel_name}</p>
										</div>
									</a>
								</div>`;
				});
				$('#content #list').html(_html);
			},
			error: function(e) { console.log(e); }
		});
	}
	tvList();
	$('body').on('change keyup input', '#search-inp', debounce(function() {
		tvList();
	}, 500));
</script>
</html>