/** Start control categories/sub categories/child categories menu **/
var childsMenus = document.querySelectorAll(".child-menu")
var controlCatMenu = document.querySelector(".control-cat-menu")
var menuCatDirectLi = document.querySelectorAll(".menu-cat  > li")
var menuSubCatDirectLi = document.querySelectorAll(".menu-sub-cat  > li")
var cat_menu = document.querySelector(".menu-cat")
var  ul = cat_menu.querySelectorAll("ul")
var  a = cat_menu.querySelectorAll("a")
a.forEach(e=>{

    e.onmouseover = ()=>{
        if (e.parentNode.parentNode.classList.contains('menu-cat'))
           ul.forEach(e=>e.classList.remove('show'))
        if (e.parentNode.parentNode.classList.contains('menu-sub-cat'))
           ul.forEach(e=>{
              if(e.classList.contains('menu-child-cat'))
                  e.classList.remove('show')
        })
        if (e.nextElementSibling)
        {
            e.nextElementSibling.classList.add('show')
        }
    }
})
controlCatMenu.onclick = () => {
	childsMenus.forEach(e => {
		if (e.classList.contains("show"))
			e.classList.remove('show')
	})
}


/** End control categories/sub categories/child categories menu **/

/** Start control mobile menu **/
var openMobileMneu = document.querySelector(".open-mobile-menu")
var closeMobileMneu = document.querySelector(".close-mobile-menu")
var mobileMenu = document.querySelector(".mobile-menu")
openMobileMneu.onclick = () => {
	mobileMenu.style.left = "0"
}
closeMobileMneu.onclick = () => {
	mobileMenu.style.left = "-300px"
}
var faCaretDown = mobileMenu.querySelectorAll(".fa-caret-down")
faCaretDown.forEach(e => {
	var a = e.parentNode;
	a.onclick = () => {
		var menu = mobileMenu.querySelector(".collapse.show")
		if (menu)
			menu.previousElementSibling.click()
	}
})
/** End control mobile menu **/

/* Start control mini cart*/
var closeMiniCart = document.querySelector(".close-min-cart")
var shoppingCartIcon = document.querySelector(".shopping-cart-icon")
var miniCart = document.querySelector(".mini-cart")
closeMiniCart.onclick = ()=>{
    miniCart.style.right = '-300px'
}
shoppingCartIcon.onclick = ()=>{
    miniCart.style.right = '0px'
}
/* End control mini cart*/



