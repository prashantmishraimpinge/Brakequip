<?php $this->extend($extendDir . 'layout'); ?>
<div id="orderProductsContainer">
<form id="orderForm" action="/order/checkout" method="post">
    <div id="orderProducts">
        <div id="orderProductsSlider">
            <?php if ($categories): ?>
            <div id="slider">
                <ul class="sliderNav mod">
                    <?php foreach ($categories as $category): ?>
                    <li><a href="#<?php echo strtoupper($category->cat) ?>"><?php echo strtoupper($category->cat) ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <div class="cb"></div>
            </div>
            <div class="list">
                <div id="listHeader">
                    <ul class="head mod">
                        <li class="col1">Part #</li>
                        <li class="col2">Description</li>
                        <li class="col3">Unit Price</li>
                        <li class="col4">Quantity</li>
                    </ul>
                    <div class="cb"></div>
                </div>
                <div class="scroll">
                    <div class="scrollContainer">
                        <?php foreach ($categories as $category): ?>
                        <div id="<?php echo strtoupper($category->cat) ?>" class="panel<?php echo $category->cat != "BQ" ? ' loadProducts' : '' ?>">
                                <?php if ($category->cat == "BQ"): ?>
                                <?php foreach (OrderProductsTable::getProductsByCategory($category->cat) as $product): ?>
                                <div class="row mod" onmouseover="this.style.background = '#f6f6f6'" onmouseout="this.style.background = '#fff'">
                                    <div class="col1"><?php echo $product->part_number ?></div>
                                    <div class="col2"><?php echo $product->description ?></div>
                                    <div class="col3">$<?php echo $product->price ?></div>
                                    <div class="col4"><input id="qty-<?php echo $product->id ?>" type="text" name="qty" class="qty" data-value="<?php echo $product->part_number ?>" value="<?php echo ($cart->getQty($product->id) ? $cart->getQty($product->id) : '') ?>" autocomplete="off" /></div>
                                </div>
                                <div class="cb"></div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <div style="padding:10px;">Loading....</div>
                                <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        

        <table cellspacing="0" cellpadding="0" align="right" class="fr">
            <tr>
                <th>Ordered by</th>
                <td><input id="orderedBy" type="text" name="ordered_by" value="" class="input storeCookie" /></td>
            </tr>
            <tr>
                <th>Order number <?php echo $user->order_no_req == 'Y' ? '*' : '' ?></th>
                <td><input id="orderNo" type="text" name="order_no" value="" class="input storeCookie<?php echo $user->order_no_req == 'Y' ? ' required' : '' ?>" /></td>
            </tr>
        </table>
    </div>




    <div id="liveOrderContainer">
        <div id="liveOrder">
            <h3>live order</h3>
            <ul class="head mod">
                <li class="col1"></li>
                <li class="col2">Part #</li>
                <li class="col3">Qty</li>
                <li class="col4">Price</li>
            </ul>
            <div class="cb"></div>
            <div id="liveList">
                <?php foreach ($cart->getItems() as $item): ?>
                <ul id="cart-<?php echo $item['id'] ?>" class="mod" onmouseover="this.style.background = '#f6f6f6'" onmouseout="this.style.background = '#fff'">
                    <li class="col1"><a href="" class="delete"><img src="/assets/images/delete.gif" title="Delete Item from Cart" /></a></li>
                    <li class="col2"><?php echo $item['part'] ?></li>
                    <li class="col3">x <?php echo $item['qty'] ?></li>
                    <li class="col4">$<?php echo $cart->getPrice($item['id']) ?></li>
                </ul>
                <div class="cb"></div>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="totals">
            <span id="totalWeight"><?php echo $cart->getTotalWeight() ?>kg</span> / <span id="totalPrice">$<?php echo number_format($cart->getTotalPrice(), 2) ?></span>
        </div>

        <div class="mod" style="height:100px;">
            <div class="fl">
                <select id="shipping" name="shipping" class="input storeCookie">
                    <option value="">Ship Via</option>
                    <option>Air Bag</option>
                    <option>Courier</option>
                    <option>Pickup</option>
                    <option>Road Express</option>
                    <option>Other</option>
                </select><br />
                <input type="text" id="shippingOther" name="shipping_other" style="width:108px;" value="Please specify" class="input default storeCookie" />
                <!--[if lt IE 8]>
                <script>
                    $('#shippingOther').attr('style', 'width:105px');
                </script>
                <![endif]-->
            </div>
            
            <input id="checkoutBtn" type="submit" name="checkout" value="Continue..." class="checkoutBtn fr" />
            <div class="cb"></div>
        </div>

    </div>
</form>
</div>

<div id="liveListTemplate" style="display:none">
    <ul id="" onmouseover="this.style.background = '#f6f6f6'" onmouseout="this.style.background = '#fff'">
        <li class="col1"><a href="" class="delete"><img src="/assets/images/delete.gif" title="Delete Item from Cart" /></a></li>
        <li class="col2"></li>
        <li class="col3"></li>
        <li class="col4"></li>
    </ul>
    <div class="cb"></div>
</div>
