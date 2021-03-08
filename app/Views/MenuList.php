<div class="banner_page">
    <img src="https://images.squarespace-cdn.com/content/v1/5a90252eda02bc96f23b007a/1519996100608-UH81HHXCYG6XXKHIXNXD/ke17ZwdGBToddI8pDm48kGTmrUSyNBpLyel9b9jKBUkUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYwL8IeDg6_3B-BRuF4nNrNcQkVuAT7tdErd0wQFEGFSnHbwYNol2rWrWhAGyFwSbbV_NbGicbmKRFgSXNPVv6eaRRpqSuyNcR2IRLmcZLGHPQ/Food_header.jpg?format=2500w">
</div>

<div class="menu_list">
    <ul class="nav nav-tabs category_list" id="myTab" role="tablist">
        <?php foreach($categories as $key => $category): ?>
        <li class="nav-item" role="presentation">
            <button data-key="<?=$category['id']?>" class="nav-link <?=$key == 0 ? 'active' : '' ?>" id="<?=$category['name']?>-tab" data-bs-toggle="tab" data-bs-target="#<?=$category['name']?>" type="button" role="tab" aria-controls="<?=$category['name']?>" aria-selected="true"><?=$category['name']?></button>
        </li>
        <?php endforeach; ?>
    </ul>

    <div class="tab-content food_list" id="myTabContent">
        <?php foreach($categories as $key => $category): ?>
        <div class="tab-pane fade show <?=$key == 0 ? 'active' : '' ?>" data-key="<?=$category['id']?>" id="<?=$category['name']?>" role="tabpanel" aria-labelledby="<?=$category['name']?>-tab">
            <ul>
                <?php foreach($menuList[$category['id']] as $key => $item): ?>
                <li>
                    <div class="item_container" onClick="add_cart(<?=$item['id']?>)">
                        <img src="<?=$item['image'] ? $item['image'] : 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/chorizo-mozarella-gnocchi-bake-cropped-9ab73a3.jpg?quality=90&resize=700%2C636' ?>">
                        <div class="details">
                            <span class="title"><?=$item['name']?></span>
                            <span class="description"><?=$item['description']?></span>
                            <span class="price">
                                PHP <?=number_format($item['price'] + $item['tax'],2,'.',',')?>
                                <i class="fa fa-plus-square"></i>
                            </span>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endforeach; ?>
    </div>
</div>