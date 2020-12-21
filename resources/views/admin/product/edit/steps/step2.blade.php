<form action="{{ url('admin/product/finish') }}" method="POST">
    @csrf
    <input type="hidden" class="product_id" name="product_id">
    <section class="_pb-2">
        <div id="main-manage-product-type">
            <div class="widget meta-boxes">
                <div class="widget-body">
                    <div id="product-variations-wrapper">
                        <div class="variation-actions">
                            <a href="javascript:void(0)" class="btn addProductVariationbtn float-right">Add New Variation</a>
                        </div>
                        <div class="product-variations-table">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="step-footer">
        <button id="btnPrev" type="button" class="btn btn-primary">Previous</button>
        <button id="btnFinish" type="submit" class="btn btn-primary">Finish</button>
    </div>
</form>
