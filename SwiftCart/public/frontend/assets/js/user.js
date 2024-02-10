var controlIcon = document.querySelectorAll(".control-icon")

controlIcon.forEach(e=>{
    e.onclick = ()=>{

       e.classList.toggle("control-icon-expand")
        var aside = e.previousElementSibling;
        aside.classList.toggle("expand")
        document.body.classList.toggle('overlay-expand')


    }
})
var logout = document.querySelector(".logout")
logout.onclick = (e)=>{
    e.preventDefault()
    e.target.parentNode.submit()
}


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
