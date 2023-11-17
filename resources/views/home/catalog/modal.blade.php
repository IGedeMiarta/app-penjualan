 <!-- Quick View Product - start -->
 <div class="qview-modal">
     <div class="prod-wrap">
         <a href="product.html">
             <h1 class="main-ttl">
                 <span id="categoryText">Template Details</span>
             </h1>
         </a>
         <div class="prod-slider-wrap">
             <div class="prod-slider-wrap">
                 <div class="prod-slider" id="imgSlider">
                 </div>
                 <div class="prod-thumbs">
                     <ul class="prod-thumbs-car" id="imgSliderMini">
                         <li>
                             <a data-slide-index="0" href="#">
                                 <img src="#" alt="">
                             </a>
                         </li>
                     </ul>
                 </div>
             </div>
         </div>
         <div class="prod-cont">
             <h1 class="mt-n5">
                 <h2 id="productName"></h2>
             </h1>

             <div class="prod-skuwrap">
                 <p class="prod-skuttl">Tags</p>
                 <ul class="prod-skucolor">
                     <div class="showTags"></div>

                 </ul>
             </div>
             <div class="prod-info">

                 <p class="prod-price">
                     <del class="disc">Rp 00,000</del>
                     <b class="item_current_price" id="price">Rp 00,000</b>
                 </p>
                 <p class="prod-addwrap">
                     <a href="#" class="prod-add"><i class="fa fa-shopping-cart  mr-2"></i> Add to cart</a>
                 </p>
             </div>
             <ul class="prod-i-props">
                 <li>

                     <p class="detailsHire"></p>
                 </li>
             </ul>
         </div>

     </div>
 </div>
 @push('script')
     <script>
         $('.btnDetails').on('click', function(e) {
             e.preventDefault();
             const id = $(this).data('id');
             const name = $(this).data('name');
             const price = $(this).data('price');
             const slug = $(this).data('slug');
             const category = $(this).data('category');
             const id_category = $(this).data('id_category');
             const tags = $(this).data('tags');
             const disc = $(this).data('disc');
             const desc = $(this).data('desc');
             var details = $(this).data('desc');
             $('#productName').html(name);
             $('.showTags').html(tags);
             $('#price').html(number_format(price));
             details = details.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
             details = details.replace(/\n/g, '<br>');
             // $('.detailsHire').html(desc.replace(/\n/g, '<br>'))
             $('.detailsHire').html(details);
             $('.disc').html(number_format(disc));
             // $('#categoryText').html(category + ' Templates')
             $('.prod-add').attr('href', `chart-add?_xcode=${price*111111}&product=${slug}`);

             $.ajax({
                 url: `/api/media/${id}`,
                 method: 'GET',
                 dataType: 'json',
                 success: function(rs) {
                     // Update the content on the webpage with the data from the server
                     let slide = ' <ul class="prod-slider-car">';
                     rs.data.media.forEach(function(url, index) {
                         slide += `<li class="float: left; list-style: none; position: relative; width: 464px;"><a data-fancybox-group="popup-product" class="fancy-img" href="${url}"  target="_blank">
                                                <img src="${url}" alt="">
                                            </a>
                                        </li>`
                     });
                     slide += '</ul>';
                     let mini = '';
                     rs.data.media.forEach(function(url, index) {
                         mini += '<li>';
                         mini += ` <a data-slide-index="${index}" href="#">
                                    <img src="${url}" alt="">
                                </a>`;
                         mini += '</li>';
                     });
                     console.log(mini);
                     $('#imgSlider').html(slide)
                     $('#imgSliderMini').html(mini)

                 },
                 error: function(xhr, status, error) {
                     console.error('Error:', error);
                 }
             });
         })

         function number_format(number) {
             return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
         }
     </script>
 @endpush
