@extends('layouts.website.app')

@section('title') Catalog @endsection

@section('styles')@endsection

@section('pageName') <body class="page-catalog dm-dark"> @endsection

@section('content')
    <main class="page-main">
        <div class="section-first-screen">
            <div class="first-screen__bg" style="background-image: url({{asset('website-assets/img/pages/contacts/bg-first-screen.jpg')}})"></div>
            <div class="first-screen__content">
                <div class="uk-container">
{{--                    category-nav--}}
                    <div class="first-screen__box">
                        <h2 class="first-screen__title">The Pizza</h2>
                        <p class="first-screen__desc">Delicious & Tasty Pizzas By Expert Chefs</p>
                        <div class="first-screen__breadcrumb">
                            <ul class="uk-breadcrumb">
                                <li><a href="/">Home</a></li>
                                <li><span>Pizza</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-banners">
            <div class="uk-section uk-container">
                <div class="uk-grid uk-grid-medium uk-child-width-1-2@m" data-uk-grid>
                    <div>
                        <div class="banner-card">
                            <div class="banner-card__bg" style="background-image: url({{asset('website-assets/img/banners/1.jpg')}})"></div>
                            <div class="banner-card__box">
                                <h4 class="banner-card__title">Get Your Pizza In Your Style,<br> With 4 Simple Steps!</h4><a class="banner-card__phone" href="tel:13205448749"><i class="fas fa-phone-square"></i><span>Call us 1-320-544-8749</span></a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="banner-card">
                            <div class="banner-card__bg" style="background-image: url({{asset('website-assets/img/banners/2.jpg')}})"></div>
                            <div class="banner-card__box">
                                <h4 class="banner-card__title">Order 11??? Pizzza &<br> Choice of One Appetizer!</h4><a class="banner-card__btn" href="#!">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="uk-container">
                <div data-uk-filter="target: .js-filter">
                    <div class="catalog-filter-row">
                        <ul class="uk-subnav">
                            <li data-uk-filter-control=""><a href="#">All</a></li>
                            <li class="uk-active" data-uk-filter-control="[data-tags='spicy']"><a href="#">Spicy</a></li>
                            <li data-uk-filter-control="[data-tags='chicken']"><a href="#">Chicken</a></li>
                            <li data-uk-filter-control="[data-tags='veglovers']"><a href="#">Veg lovers</a></li>
                            <li data-uk-filter-control="[data-tags='meat']"><a href="#">Meat</a></li>
                        </ul><select class="uk-select" name="orderby" aria-label="Shop order">
                            <option value="menu_order" selected>Sorting by</option>
                            <option value="popularity">Sort by popularity</option>
                            <option value="rating">Sort by average rating</option>
                            <option value="date">Sort by latest</option>
                            <option value="price">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to low</option>
                        </select>
                    </div>
                    <ul class="js-filter uk-grid uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" data-uk-grid>
                        <li data-tags="spicy">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-1.png')}}"><img src="{{asset('website-assets/img/products/pizza-1.png')}}" alt="Creamy Melt Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type spicy"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: spicy pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Creamy Melt Pizza</a></div>
                                            <div class="product-item__desc">Spicy Cheese pizza with topping of beef pepperoni &amp; sauce</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-1" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-1" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-1" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-1" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-1" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-1" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$14.99</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="chicken">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-2.png')}}"><img src="{{asset('website-assets/img/products/pizza-2.png')}}" alt="Neapolitan Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type vegetarian"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: vegetarian pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Neapolitan Pizza</a></div>
                                            <div class="product-item__desc">Pizza topped with ringed shap chicken slices &amp; tomytos</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-2" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-2" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-2" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-2" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-2" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-2" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$15.30</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="veglovers">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-3.png')}}"><img src="{{asset('website-assets/img/products/pizza-3.png')}}" alt="Hot n Spicy Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type vegetarian"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: vegetarian pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Hot n Spicy Pizza</a></div>
                                            <div class="product-item__desc">Spicy Cheese pizza with topping of beef pepperoni &amp; sauce</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-3" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-3" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-3" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-3" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-3" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-3" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$9.50</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="meat">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-4.png')}}"><img src="{{asset('website-assets/img/products/pizza-4.png')}}" alt="Chees???on Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type spicy"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: spicy pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Chees???on Pizza</a></div>
                                            <div class="product-item__desc">Pizza topped with ringed shap chicken slices &amp; tomytos</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-4" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-4" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-4" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-4" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-4" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-4" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$20.45</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="meat">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-1.png')}}"><img src="{{asset('website-assets/img/products/pizza-1.png')}}" alt="Creamy Melt Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type spicy"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: spicy pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Creamy Melt Pizza</a></div>
                                            <div class="product-item__desc">Spicy Cheese pizza with topping of beef pepperoni &amp; sauce</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-1" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-1" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-1" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-1" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-1" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-1" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$14.99</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="veglovers">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-2.png')}}"><img src="{{asset('website-assets/img/products/pizza-2.png')}}" alt="Neapolitan Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type vegetarian"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: vegetarian pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Neapolitan Pizza</a></div>
                                            <div class="product-item__desc">Pizza topped with ringed shap chicken slices &amp; tomytos</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-2" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-2" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-2" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-2" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-2" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-2" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$15.30</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="chicken">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-3.png')}}"><img src="{{asset('website-assets/img/products/pizza-3.png')}}" alt="Hot n Spicy Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type vegetarian"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: vegetarian pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Hot n Spicy Pizza</a></div>
                                            <div class="product-item__desc">Spicy Cheese pizza with topping of beef pepperoni &amp; sauce</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-3" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-3" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-3" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-3" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-3" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-3" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$9.50</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="spicy">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-4.png')}}"><img src="{{asset('website-assets/img/products/pizza-4.png')}}" alt="Chees???on Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type spicy"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: spicy pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Chees???on Pizza</a></div>
                                            <div class="product-item__desc">Pizza topped with ringed shap chicken slices &amp; tomytos</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-4" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-4" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-4" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-4" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-4" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-4" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$20.45</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="spicy">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-1.png')}}"><img src="{{asset('website-assets/img/products/pizza-1.png')}}" alt="Creamy Melt Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type spicy"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: spicy pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Creamy Melt Pizza</a></div>
                                            <div class="product-item__desc">Spicy Cheese pizza with topping of beef pepperoni &amp; sauce</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-1" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-1" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-1" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-1" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-1" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-1" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$14.99</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="chicken">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-2.png')}}"><img src="{{asset('website-assets/img/products/pizza-2.png')}}" alt="Neapolitan Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type vegetarian"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: vegetarian pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Neapolitan Pizza</a></div>
                                            <div class="product-item__desc">Pizza topped with ringed shap chicken slices &amp; tomytos</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-2" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-2" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-2" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-2" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-2" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-2" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$15.30</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="veglovers">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-3.png')}}"><img src="{{asset('website-assets/img/products/pizza-3.png')}}" alt="Hot n Spicy Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type vegetarian"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: vegetarian pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Hot n Spicy Pizza</a></div>
                                            <div class="product-item__desc">Spicy Cheese pizza with topping of beef pepperoni &amp; sauce</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-3" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-3" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-3" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-3" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-3" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-3" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$9.50</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="meat">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-4.png')}}"><img src="{{asset('website-assets/img/products/pizza-4.png')}}" alt="Chees???on Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type spicy"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: spicy pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Chees???on Pizza</a></div>
                                            <div class="product-item__desc">Pizza topped with ringed shap chicken slices &amp; tomytos</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-4" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-4" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-4" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-4" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-4" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-4" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$20.45</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="meat">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-1.png')}}"><img src="{{asset('website-assets/img/products/pizza-1.png')}}" alt="Creamy Melt Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type spicy"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: spicy pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Creamy Melt Pizza</a></div>
                                            <div class="product-item__desc">Spicy Cheese pizza with topping of beef pepperoni &amp; sauce</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-1" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-1" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-1" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-1" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-1" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-1" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$14.99</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="veglovers">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-2.png')}}"><img src="{{asset('website-assets/img/products/pizza-2.png')}}" alt="Neapolitan Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type vegetarian"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: vegetarian pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Neapolitan Pizza</a></div>
                                            <div class="product-item__desc">Pizza topped with ringed shap chicken slices &amp; tomytos</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-2" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-2" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-2" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-2" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-2" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-2" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$15.30</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="chicken">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-3.png')}}"><img src="{{asset('website-assets/img/products/pizza-3.png')}}" alt="Hot n Spicy Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type vegetarian"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: vegetarian pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Hot n Spicy Pizza</a></div>
                                            <div class="product-item__desc">Spicy Cheese pizza with topping of beef pepperoni &amp; sauce</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-3" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-3" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-3" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-3" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-3" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-3" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$9.50</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li data-tags="spicy">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">
                                                <div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox"><a href="{{asset('website-assets/img/products/pizza-4.png')}}"><img src="{{asset('website-assets/img/products/pizza-4.png')}}" alt="Chees???on Pizza" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a></div>
                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>
                                                <div class="product-item__type spicy"></div>
                                                <div class="product-item__tooltip" data-uk-tooltip="title: spicy pizza; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title"><a href="page-product.html">Chees???on Pizza</a></div>
                                            <div class="product-item__desc">Pizza topped with ringed shap chicken slices &amp; tomytos</div>
                                            <div class="product-item__select">
                                                <div class="select-box select-box--thickness">
                                                    <ul>
                                                        <li><label><input type="radio" name="thickness-4" checked="checked" /><span>Thin</span></label></li>
                                                        <li><label><input type="radio" name="thickness-4" /><span>Normal</span></label></li>
                                                        <li><label><input type="radio" name="thickness-4" /><span>Thick</span></label></li>
                                                    </ul>
                                                </div>
                                                <div class="select-box select-box--size">
                                                    <ul>
                                                        <li><label><input type="radio" name="size-4" /><span>7 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-4" /><span>9 ???</span></label></li>
                                                        <li><label><input type="radio" name="size-4" checked="checked" /><span>11 ???</span></label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__active">
                                            <div class="title">Add Ingredients</div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sausage Salami</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Becon</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sauce "City Pizza"</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Meat Board</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Pineapples</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">35 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Sweet Pepper</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">40 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Mushroom Mix</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">20 s</div>
                                            </div>
                                            <div class="row">
                                                <div class="name">Fine Susage</div>
                                                <div class="col"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></div>
                                                <div class="price">55 s</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__toggle"> <button type="button"> <span>Additional Ingredients</span></button></div>
                                    <div class="product-item__info">
                                        <div class="product-item__price"> <span>Price: </span><span class="value">$20.45</span></div>
                                        <div class="product-item__addcart"> <a class="uk-button uk-button-default" href="page-product.html">Add to Cart<span data-uk-icon="cart"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="uk-margin-medium-top uk-text-center"><button class="uk-button" type="button">Load more </button></div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')@endsection
