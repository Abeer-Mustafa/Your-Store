
<input type="hidden" id="main_min_price" name="main_min_price" value="{{$minPrice}}">
<input type="hidden" id="main_max_price" name="main_max_price" value="{{$maxPrice}}">
@if(Route::is('category.show'))
    <input type="hidden" id="mainMainCat" name="mainMainCat" value="{{$cat->id}}">
@endif

<form id="hidden_values" action="">
    @if(Route::is('category.show'))
    <input type="hidden" id="mainCat" name="mainCat" value="{{$cat->id}}">
    <input type="hidden" id="brandValue" name="brandValue" value="0">
    @elseif(Route::is('brand.show') )
    <input type="hidden" id="mainBrand" name="mainBrand" value="{{$brand->id}}">
    @elseif(Route::is('search.show'))
    <input type="hidden" id="input_search" name="input_search" value="{{$input}}">
    @endif
    <input type="hidden" id="cat" name="cat" value="0">
    <input type="hidden" id="brand" name="brand" value="0">
    <input type="hidden" id="limit" name="limit" value="1000000">
    <input type="hidden" id="sort" name="sort" value="created_DESC">
    <input type="hidden" id="min_price" name="min_price" value="{{$minPrice}}">
    <input type="hidden" id="max_price" name="max_price" value="{{$maxPrice}}">
    <input type="hidden" id="Red" name="Red" value="0">
    <input type="hidden" id="White" name="White" value="0">
    <input type="hidden" id="Blue" name="Blue" value="0">
    <input type="hidden" id="Green" name="Green" value="0">
    <input type="hidden" id="Pink" name="Pink" value="0">
    <input type="hidden" id="Gray" name="Gray" value="0">
    <input type="hidden" id="Purple" name="Purple" value="0">
    <input type="hidden" id="Orange" name="Orange" value="0">
    <input type="hidden" id="Yellow" name="Yellow" value="0">
    <input type="hidden" id="Brown" name="Brown" value="0">
    <input type="hidden" id="Black" name="Black" value="0">
    <input type="hidden" id="XS" name="XS" value="0">
    <input type="hidden" id="S" name="S" value="0">
    <input type="hidden" id="XXS" name="XXS" value="0">
    <input type="hidden" id="M" name="M" value="0">
    <input type="hidden" id="L" name="L" value="0">
    <input type="hidden" id="XL" name="XL" value="0">
    <input type="hidden" id="XXL" name="XXL" value="0">
</form>