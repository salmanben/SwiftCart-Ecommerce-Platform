/************* Start Layout Scripts **************/
var aside = document.querySelector('aside');
var controlSidebar = document.querySelector("nav .fa-bars");
var siteContent = document.querySelector(".site-content");
var spans = aside.querySelectorAll('span');
var menu = document.querySelectorAll("aside .sidebar-body > ul > li.menu")

if (window.innerWidth > 990) {
	controlSidebar.onclick = () => {
		aside.classList.toggle('collapsed-lg');
		siteContent.classList.toggle('grow-lg');
		var spans = aside.querySelectorAll('span');
		spans.forEach(e => {

			if (!e.classList.contains('hide-title-from-menu') && e.parentNode.hasAttribute('aria-expanded') && e.parentNode.getAttribute('aria-expanded') == 'true') {

				e.parentNode.setAttribute('aria-expanded', 'false')
				e.parentNode.classList.add('collapsed')
				if (e.parentNode.nextElementSibling)
					e.parentNode.nextElementSibling.classList.remove('show')
			}


			e.classList.toggle('hide-title-from-menu')

		});
		var tooltips = Array.from(document.querySelectorAll('[data-title]'));
		if (aside.classList.contains('collapsed-lg')) {
			tooltips.forEach(e => {
				e.setAttribute('title', e.getAttribute('data-title'))
				tooltips.forEach(e => new bootstrap.Tooltip(e));
				e.parentNode.onclick = () => {
					if (aside.classList.contains('collapsed-lg')) {
						tooltips.forEach(e => {
							e.removeAttribute('data-bs-original-title')
							e.removeAttribute('title')
							const tooltip = bootstrap.Tooltip.getInstance(e);
							if (tooltip) {
								tooltip.dispose();
							}

						});
						spans.forEach(e => {
							e.classList.remove('hide-title-from-menu')
						});
						aside.classList.remove('collapsed-lg')
						siteContent.classList.remove('grow-lg');
					}

				}
			});
		} else {
			tooltips.forEach(e => e.removeAttribute('data-bs-original-title'));
			menu.forEach(e => {
				if (e.classList.contains("active")) {
					var a = e.querySelector(".menu > a")
					a.setAttribute('aria-expanded', 'true')
					a.classList.remove('collapsed')
					if (a.nextElementSibling)
						a.nextElementSibling.classList.add('show')
				}

			})

		}


	};


} else {

	controlSidebar.onclick = () => {
		aside.classList.toggle('expand-md')
		document.body.classList.toggle('overlay-expand')
	}
	document.body.onclick = (e) => {
		if (e.target.parentNode == controlSidebar)
			return
		if (aside.classList.contains('expand-md')) {
			if (e.pageX > 250) {
				aside.classList.remove('expand-md')
				document.body.classList.toggle('overlay-expand')
				menu.forEach((e, i) => {
					var a = e.querySelector('a')
					if (i !== 0 && !a.classList.contains('collapsed')) {
						a.removeAttribute('aria-expanded')
						a.classList.add('collapsed')
						if (a.nextElementSibling)
							a.nextElementSibling.classList.remove('show')
					}

				})

			}

		}
	}
}


menu.forEach(e => {
	if (e.classList.contains("active")) {
		var a = e.querySelector(` a`)
		a.setAttribute('aria-expanded', 'true')
		a.classList.remove('collapsed')
		if (a.nextElementSibling)
			a.nextElementSibling.classList.add('show')
	}

})

var logout = document.querySelector(".logout")
logout.onclick = (event) => {
	event.preventDefault()
	event.target.parentNode.submit()

}

/********** End Layout Scripts **********/

/************ Delete row from table *************/
function delete_row(e) {
    e.preventDefault()
	var url = e.currentTarget.getAttribute('href');
    var tr = e.currentTarget.parentNode.parentNode
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then(function(result) {
		if (result.isConfirmed) {
			fetch(url, {
					method: 'DELETE',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}

				})
				.then(res => res.json())
				.then(data => {
					if (data.status == 'success') {
						tr.remove()

						Swal.fire(
							'Deleted!',
							data.message

						)


					} else if (data.status == 'error') {
						Swal.fire(
							'Error',
							data.message

						)
					}

				})
				.catch(function(error) {
                    console.log(error)
					Swal.fire(
						'Error',
						"Can't be deleted!"
					)
				});
		}
	});

}


