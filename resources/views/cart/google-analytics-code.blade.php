<script src="{{ url('/secure/whmcs-products') }}"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag() {

    dataLayer.push(arguments);

  }

</script>

<script>

    const globalRequestParamOne = '{{ Request::segment(1) }}';

    const globalRequestParamTwo = '{{ Request::segment(2) }}';

    const globalsys_currency = '{{ Config::get('Constant.sys_currency') }}';



    var requestParamOneArr = [

        "hosting",

        "web-hosting-ahmedabad",

        "servers",

        "email",

        "ssl-certificates",

        "web-hosting"

    ];

    var requestParamTwoArr = [

        "linux-hosting",

        "windows-hosting",

        "wordpress-hosting",

        "ecommerce-hosting",

        "website-builder",

        "vps-hosting",

        "managed-vps-hosting",

        "linux-vps-hosting",

        "windows-vps-hosting",

        "forex-vps-hosting",

        "dedicated-servers",

        "microsoft-office-365-suite"

    ];

    if (jQuery.inArray(globalRequestParamOne, requestParamOneArr) !== -1) {

        if (

            jQuery.inArray(globalRequestParamTwo, requestParamTwoArr) !== -1 ||

            globalRequestParamOne === "ssl-certificates" ||

            globalRequestParamOne === "web-hosting-ahmedabad" ||

            globalRequestParamOne === "web-hosting"

        ) {

            onCheckProductDetailPage();

            

        }

    }

    if(globalRequestParamOne == 'cart' && globalRequestParamTwo == 'thankyou'){

        @if (isset($data['orderid']) && !empty($data['orderid']))

            const orderId = {{ $data['orderid'] }};

            EventPurchase(orderId);

        @endif

    }

    function getActionData(postdata) {

        var result;

        var url = "https://manage.hostitsmart.com/get_transactions_detials.php";

        $.ajax({

            async: false,

            url: url,

            data: postdata,

            type: "post",

            success: function (res) {

                result = JSON.parse(res);

            },

            error: function (xhr, status, error) {

                console.error("Error fetching data: ", error);

            }

        });

        return result;

    }

    function getproductsdetails(ele) {

        if (window.whmcsProducts && typeof window.whmcsProducts === 'object') {

            let whmcsProducts = Object.values(window.whmcsProducts);

            const indexedProducts = whmcsProducts.reduce((acc, product) => {

                acc[product.pid] = product;

                return acc;

            }, {});



            if (!Array.isArray(ele)) {

                return indexedProducts[ele] || null;

            }

            return ele.map(id => indexedProducts[id] || null).filter(product => product !== null);

        } else {

            console.error('whmcsProducts is not defined or not an array');

            return null;

        }

    }



    function onCheckProductDetailPage() {

        let pid = [];

        @if(isset($ProductsPackageData) && !empty($ProductsPackageData))

        var productsPackageData = @json($ProductsPackageData);

        productsPackageData.forEach(product => {

            pid.push(product.fkWhmcsProduct);

        });

        var productsdetails = getproductsdetails(pid);

        @endif

        let type = globalRequestParamTwo || globalRequestParamOne;

        let products = [];

        productsdetails.forEach(product => {

            let price = 0,

            variant = '';

            const pricingOptions = ['triennially', 'biennially', 'annually', 'semiannually', 'quarterly', 'monthly'];



            for (let option of pricingOptions) {

                if (product.pricing.USD[option] > 0) {

                    price = product.pricing[globalsys_currency][option];

                    variant = option;

                    break;

                }

            }

            products.push({

                item_id: product.pid,

                item_name: product.name,

                price: price,

                item_category: type,

                item_variant: variant

            });

        });

        if(products){

            gtag("event", "view_item_list", {

              items: products

            });

        }

    }

    function addToCartEvent(ele){

        let products = [];

        var formid = $(ele).parent().attr("id");

        let type = globalRequestParamTwo || globalRequestParamOne;

        if (formid.indexOf('form_dedicatedserver') === -1) {

            var pid = $("#" + formid).find("input[name^='pid']").val();

            var billing = $("#" + formid).find("input[name^='billingcycle']").val();

            var location = $("#" + formid).find("input[name^='location']").val();

            var productData = getproductsdetails(pid);

            products.push({

                id: productData.pid,

                currencyCode: globalsys_currency,

                name: productData.name,

                price: productData.pricing[globalsys_currency][billing],

                category: type,

                location: location,

                variant: billing

            });

            if (productData) {

                var price = '';

                gtag("event", "add_to_cart", {

                  currency: globalsys_currency,

                  value: productData.pricing[globalsys_currency][billing],

                  items: [

                    {

                      item_id: productData.pid,

                      item_name: productData.name,

                      item_category: type,

                      item_variant: billing,

                      price: productData.pricing[globalsys_currency][billing],

                      quantity: 1

                    }

                  ]

                });

            }

        }else{

            return false;

        }

    }

    function removeCartItemAnalytices(formData,frmkey){

        let billingcycle, productData, pid, result, price, name, variant;

        const products = [];

        const url = "{{ URL::to('/') }}/cart/removeCartItemAnalytices";



        // Perform AJAX request to get cart item details

        $.ajax({

            async: false, // Blocking call; consider changing this if possible

            url: url,

            data: formData,

            type: "post",

            success: function (res) {

                try {

                    result = JSON.parse(res);

                } catch (error) {

                    console.error("Error parsing response JSON:", error);

                    return;

                }

            },

            error: function (xhr, status, error) {

                console.error("AJAX request failed:", status, error);

                return;

            }

        });



        // Extract details from the response

        if (result) {

            pid = result.pid;

            billingcycle = result.billingcycle;

            productData = getproductsdetails(pid);



            // Determine price, name, and variant with fallback values

            price = productData?.pricing?.[globalsys_currency]?.[billingcycle] || 

                    result?.pricing?.[result.regperiod]?.[result.domaintype] || 

                    0;

            name = productData?.name || result?.producttype || "Unknown Product";

            variant = billingcycle || result?.regperiod || "Unknown Variant";

            gtag("event", "remove_from_cart", {

              currency: "INR",

              value: price,

              items: [

                {

                  item_name: name,

                  item_category: result?.groupname || result.domaintype,

                  item_variant: variant,

                  price: price,

                  quantity: 1

                }

              ]

            });

        } else {

            console.error("No result data found from the server response.");

        }

    }

    function emptyCartItemAnalytices() {

        var formData = {

            _token: '{{ csrf_token() }}'

        };

        var url = "{{ URL::to('/') }}/cart/removeCartItemAnalytices";

        var result = [];

        var products = [];

        var products1 = [];



        // Perform AJAX request

        $.ajax({

            async: false,

            url: url,

            data: formData,

            type: "post",

            success: function (res) {

                result = JSON.parse(res);

            },

            error: function () {

                console.error("Failed to fetch cart analytics.");

            }

        });



        // Process each item in the result

        $.each(result, function (i, item) {

            let name, price, category, billingcycle;



            if (item.producttype === 'hosting') {

                let productData = getproductsdetails(item.pid);

                name = productData.name;

                price = productData.pricing?.[globalsys_currency]?.[item.billingcycle] || 0;

                category = item.groupname;

                billingcycle = item.billingcycle;

            } else {

                name = item.producttype;

                price = item.pricing?.[item.regperiod]?.[item.domaintype] || 0;

                category = item.domaintype;

                billingcycle = item.regperiod;

            }



            // Construct product object

            var productObj = {

                name: name,

                price: price,

                category: category || "Unknown",

                variant: billingcycle || "N/A",

                quantity: 1

            };



            products1.push(productObj);

        });

        window.dataLayer = window.dataLayer || [];

        window.dataLayer.push({ ecommerce: null });

        window.dataLayer.push({

            'event': 'remove_from_cart',

            'ecommerce': {

                'remove': {

                    'products': products1

                }

            }

        });

    }

    function EventPurchase(postdata){

        var productData = getActionData({ 

                        action: "getorderdetails",

                        pid : postdata

                    });

        const order = productData.orders.order[0]; // Get the first order

        const amount = order.amount; // Store amount

        const currency = order.currencyprefix; // Store currency prefix

        const order_id = order.id; // Store order ID

        const products = order.lineitems.lineitem.map(item => ({

                item_category: item.producttype,

                item_name: item.product.split('-').slice(1).join('-').trim(),

                item_variant: item.billingcycle,

                price: item.amount.replace('INR ', ''),

                quantity: 1

            }));

        window.dataLayer = window.dataLayer || [];

        window.dataLayer.push({ ecommerce: null });

        window.dataLayer.push({

          event: "purchase",

          ecommerce: {

            value: amount,

            currency: currency,

            items: products

          }

        });

    }



</script>

