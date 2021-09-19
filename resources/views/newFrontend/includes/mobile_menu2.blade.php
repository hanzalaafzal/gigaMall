<div class="ps-panel--sidebar" id="menu-mobile">
    <div class="ps-panel__header">
        <h3>Menu</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
          <?php
            if (Auth::check()) {
              $carts = App\Helpers\Helper_user::carts();
              $categories = App\Helpers\Helper_user::getCategories();
            }
          ?>
          @foreach($categories as $category)
          <li class="menu-item-has-children has-mega-menu">
            <a href="{{url('/products/search?category='.$category->slug)}}">{{$category->name}}</a>

          </li>
          @endforeach
        </ul>
    </div>
</div>
