<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\BecomeADealer;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Enquiry;
use App\Models\FindADealer;
use App\Models\Product;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Gallery;
use App\Models\HeaderContent;
use App\Models\Testimonial;
use App\Models\VideoGallery;
use App\Models\Subscribe;
use App\Models\Dealer;
use App\Models\FarmerRegistration;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
   public function home()
    {
        $headerContent = HeaderContent::where('page_name', 'home')->where('status', 1)->first();
        $products = Product::where('show_in_home', 1)->where('status', 1)->latest()->get();
        $testimonials = Testimonial::where('status', 1)->latest()->get();

        // Optimized SEO meta tags for Laser Land Leveller keywords
        $meta_title = !empty($headerContent->meta_title) ? $headerContent->meta_title : 'Laser Land Leveller India | Best Laser Land Leveler Manufacturer | Apogee Agrotech';
        $meta_keywords = !empty($headerContent->meta_keywords) ? $headerContent->meta_keywords : 'laser land leveller, laser land leveler, laser land leveller india, laser land leveler manufacturer india, best laser land leveller, laser guided land leveller, GNSS land leveller, laser land leveller price, laser land leveller machine, laser land leveller for agriculture, laser land leveller bucket, laser land leveller system, precision land levelling, agricultural land leveller, laser leveller equipment, laser land leveller dealer, laser land leveller supplier, laser land leveller UP, laser land leveller Hapur, apogee laser land leveller, bahubali laser land leveller, laser land leveller cost, laser land leveller benefits, laser land leveller technology, laser land leveller manufacturers, laser land leveller exporters, laser land leveller price in india, laser land leveller online, buy laser land leveller';
        $meta_description = !empty($headerContent->meta_description) ? $headerContent->meta_description : 'Apogee Agrotech - India\'s Leading Manufacturer of Laser Land Leveller & Laser Land Leveler Equipment. Best Quality GNSS & Laser Guided Land Levelling Systems for Precision Agriculture. Get Best Price on Laser Land Levellers in India. Call +91 7624002265';
        $header_content = @$headerContent->head_content;
        return view('front.home', compact('headerContent', 'products', 'meta_title', 'meta_keywords', 'meta_description', 'header_content', 'testimonials'));
    }

    public function AboutUs()
    {
        $meta_title = "About Us - Laser Land Leveller Manufacturer India | Apogee Agrotech";
        $meta_keywords = "about apogee agrotech, laser land leveller manufacturer, laser land leveler company india, agricultural equipment manufacturer, precision farming equipment, GNSS land leveller manufacturer, laser guided equipment, apogee agrotech history, laser land leveller company";
        $meta_description = "Learn about Apogee Agrotech - India's leading manufacturer of Laser Land Leveller and Laser Land Leveler equipment. Discover our journey in precision agriculture and commitment to quality. Call +91 7624002265";
        $schema_type = 'AboutPage';
        return view('front.company.about-us', compact('meta_title', 'meta_keywords', 'meta_description', 'schema_type'));
    }
     public function TimeLine()
    {
        $meta_title = "Company Timeline - Laser Land Leveller Manufacturer History | Apogee Agrotech";
        $meta_keywords = "apogee agrotech timeline, laser land leveller company history, agricultural equipment manufacturer history, precision farming evolution, laser land leveller development, company milestones, apogee agrotech journey";
        $meta_description = "Explore the timeline of Apogee Agrotech - India's premier Laser Land Leveller manufacturer. Discover our milestones, innovations, and growth in precision agriculture equipment manufacturing.";
        $schema_type = 'AboutPage';
        return view('front.company.time-line', compact('meta_title', 'meta_keywords', 'meta_description', 'schema_type'));
    }

    public function ProductListing($category_slug, $subcategory_slug)
    {
        // dd($category_slug, $subcategory_slug);
        $category = Category::where('slug', $category_slug)->where('status', 1)->first();
        if (!$category) {
            return redirect('404');
        }
        $category_name = @$category->name;

        $subcategory = SubCategory::where('category_id', $category->id)->where('slug', $subcategory_slug)->where('status', 1)->first();
        if (!$subcategory) {
            return redirect('404');
        }
        $subcategory_name = @$subcategory->name;

        $productlisting = Product::where('status', 1);
        if (!empty($category->id)) {
            // dd($category->id);
            $productlisting->where('category_id', $category->id);
            // dd($productlisting->get());
        }
        if (!empty($subcategory->id)) {
            // dd($subcategory->id);
            $productlisting->where('subcategory_id', $subcategory->id);
            // dd($productlisting->get());
        }

        $productlisting = $productlisting->latest()->get();



        $AllCategory = Category::where('status', 1)->latest()->get();


        $meta_title = !empty($subcategory->meta_title) ? $subcategory->meta_title : $subcategory_name . ' - ' . $category_name . ' | Laser Land Leveller | Apogee Agrotech';
        $meta_keywords = !empty($subcategory->meta_keywords) ? $subcategory->meta_keywords : strtolower($subcategory_name) . ', ' . strtolower($category_name) . ', laser land leveller, laser land leveler, precision agriculture equipment, apogee agrotech';
        $meta_description = !empty($subcategory->meta_description) ? $subcategory->meta_description : 'Browse ' . $subcategory_name . ' products from ' . $category_name . ' category. Best quality Laser Land Leveller equipment by Apogee Agrotech. Get best prices in India.';
        $header_content = @$subcategory->head_content;
        $schema_type = 'CollectionPage';
        $category = $category;
        $subcategory = $subcategory;
        return view('front.product-listing', compact('productlisting', 'category_name', 'subcategory_name', 'AllCategory', 'meta_title', 'meta_keywords', 'meta_description', 'header_content', 'schema_type', 'category', 'subcategory'));
    }

    public function ProductListingCategory($category_slug)
    {
        // dd($category_slug, $subcategory_slug);
        $category = Category::where('slug', $category_slug)->where('status', 1)->first();
        if (!$category) {
            return redirect('404');
        }
        $category_name = @$category->name;

        $productlisting = Product::where('status', 1);
        if (!empty($category->id)) {
            // dd($category->id);
            $productlisting->where('category_id', $category->id);
            // dd($productlisting->get());
        }

        $productlisting = $productlisting->latest()->get();



        $AllCategory = Category::where('status', 1)->latest()->get();
        $headerContent = HeaderContent::where('page_name', 'product_list')->where('status', 1)->first();
        
         $meta_title = !empty($category->meta_title) ? $category->meta_title : $category_name . ' - Laser Land Leveller Products | Apogee Agrotech';
        $meta_keywords = !empty($category->meta_keywords) ? $category->meta_keywords : strtolower($category_name) . ', laser land leveller, laser land leveler, precision agriculture equipment, agricultural machinery, apogee agrotech products';
        $meta_description = !empty($category->meta_description) ? $category->meta_description : 'Explore ' . $category_name . ' products by Apogee Agrotech. Best quality Laser Land Leveller equipment for precision agriculture. Get best prices in India. Call +91 7624002265';
        $header_content = @$category->head_content;
        $schema_type = 'CollectionPage';
        return view('front.product-listing', compact('productlisting', 'category_name', 'AllCategory', 'headerContent', 'meta_title', 'meta_keywords', 'meta_description', 'header_content', 'schema_type', 'category'));
    }

     public function productDatels($product_slug)
    {
        $product = Product::where('slug', $product_slug)->where('status', 1)->first();
        if (!$product) {
            return redirect('404');
        }
        // dd($product);
        $RelatedProducts = Product::where('category_id', $product->category_id)->where('subcategory_id', $product->subcategory_id)->where('status', 1)->latest()->get();


        $meta_title = !empty($product->meta_title) ? $product->meta_title : $product->product_name . ' - Laser Land Leveller | Apogee Agrotech';
        $meta_keywords = !empty($product->meta_keywords) ? $product->meta_keywords : strtolower($product->product_name) . ', laser land leveller, laser land leveler, precision agriculture, agricultural equipment, apogee agrotech, ' . strtolower($product->product_name) . ' price';
        $meta_description = !empty($product->meta_description) ? $product->meta_description : $product->product_name . ' by Apogee Agrotech. ' . (!empty($product->short_description) ? strip_tags($product->short_description) : 'Best quality Laser Land Leveller equipment for precision agriculture.') . ' Get best price in India.';
        $header_content = @$product->head_content;
        $schema_type = 'Product';
        return view('front.product-datels', compact('product', 'RelatedProducts', 'meta_title', 'meta_keywords', 'meta_description', 'header_content', 'schema_type'));
    }


    // Media
     public function ImageGallery()
    {
        $session = Session::where('status', 1)->get();
        $headerContent = HeaderContent::where('page_name', 'photo_gallery')->where('status', 1)->first();

        
        $meta_title = !empty($headerContent->meta_title) ? $headerContent->meta_title : 'Image Gallery - Laser Land Leveller Photos & Images | Apogee Agrotech';
        $meta_keywords = !empty($headerContent->meta_keywords) ? $headerContent->meta_keywords : 'laser land leveller images, laser land leveller photos, apogee agrotech gallery, agricultural equipment images, precision farming photos, laser land leveller pictures, GNSS land leveller images';
        $meta_description = !empty($headerContent->meta_description) ? $headerContent->meta_description : 'Browse our image gallery showcasing Laser Land Leveller equipment, precision agriculture solutions, and customer success stories. High-quality photos of Apogee Agrotech products.';
        $schema_type = 'ImageGallery';
        return view('front.media.image-gallery', compact('session', 'meta_title', 'meta_keywords', 'meta_description', 'schema_type', 'headerContent'));
    }

   public function VideoGallery(){
        $videoGallery = VideoGallery::where('status', 1)->latest()->get();
        $headerContent = HeaderContent::where('page_name', 'video_gallery')->where('status', 1)->first();

        $meta_title = !empty($headerContent->meta_title) ? $headerContent->meta_title : 'Video Gallery - Laser Land Leveller Videos & Demonstrations | Apogee Agrotech';
        $meta_keywords = !empty($headerContent->meta_keywords) ? $headerContent->meta_keywords : 'laser land leveller videos, laser land leveller demonstrations, apogee agrotech videos, agricultural equipment videos, precision farming videos, laser land leveller tutorials, GNSS land leveller videos';
        $meta_description = !empty($headerContent->meta_description) ? $headerContent->meta_description : 'Watch videos of Laser Land Leveller equipment in action. Product demonstrations, customer testimonials, and tutorials from Apogee Agrotech - India\'s leading manufacturer.';
        $schema_type = 'VideoGallery';
        return view('front.media.video-gallery', compact('videoGallery', 'meta_title', 'meta_keywords', 'meta_description', 'schema_type', 'headerContent'));
    }
    public function Blog(){
        $blog = Blog::where('status', 1)->latest()->get();
        $meta_title = 'Blog - Laser Land Leveller Articles, News & Tips | Apogee Agrotech';
        $meta_keywords = 'laser land leveller blog, precision agriculture articles, farming tips, agricultural equipment news, laser land leveller guides, farming technology blog, apogee agrotech blog';
        $meta_description = 'Read latest articles, news, and tips about Laser Land Leveller equipment, precision agriculture, and farming technology. Expert insights from Apogee Agrotech.';
        $schema_type = 'Blog';
        return view('front.media.blog', compact('blog', 'meta_title', 'meta_keywords', 'meta_description', 'schema_type'));
    }
   public function BlogDatels($slug){
        // dd($slug);
        $blogdatels = Blog::where('slug', $slug)->where('status', 1)->first();
        if (!$blogdatels) {
            return redirect('404');
        }

        $blogs = Blog::where('status', 1)->latest()->take(5)->get();

        $meta_title = !empty($blogdatels->meta_title) ? $blogdatels->meta_title : $blogdatels->title . ' - Laser Land Leveller Blog | Apogee Agrotech';
        $meta_keywords = !empty($blogdatels->meta_keywords) ? $blogdatels->meta_keywords : strtolower($blogdatels->title) . ', laser land leveller, precision agriculture, farming tips, agricultural equipment, apogee agrotech blog';
        $meta_description = !empty($blogdatels->meta_description) ? $blogdatels->meta_description : (!empty($blogdatels->short_description) ? strip_tags($blogdatels->short_description) : $blogdatels->title . ' - Read latest insights about Laser Land Leveller and precision agriculture from Apogee Agrotech.');
        $header_content = @$blogdatels->head_content;
        $schema_type = 'BlogPosting';
        return view('front.media.blog-datels', compact('blogdatels', 'blogs', 'meta_title', 'meta_keywords', 'meta_description', 'header_content', 'schema_type'));

    }
 
    // Network
    public function BecomeADealer(){
        $meta_title = "Become a Dealer - Laser Land Leveller Dealer Program | Apogee Agrotech";
        $meta_keywords = "become laser land leveller dealer, apogee agrotech dealer program, agricultural equipment dealership, laser land leveller distributor, dealer opportunity, agricultural machinery dealer, precision farming equipment dealer";
        $meta_description = "Join Apogee Agrotech as a dealer and sell Laser Land Leveller equipment. Exclusive dealer program with best margins, marketing support, and training. Apply now to become our authorized dealer.";
        $schema_type = 'ContactPage';
        return view('admin.network.become-a-dealer', compact('meta_title', 'meta_keywords', 'meta_description', 'schema_type'));
    }
    public function SaveBecomeForm(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:10|integer',
            'state' => 'required',
            'district' => 'required',
            'village' => 'required',
            'intersted_in' => 'required',
        ]);

        $becomeaDealerObj = new BecomeADealer();
        $becomeaDealerObj->name = $request->name;
        $becomeaDealerObj->email = $request->email;
        $becomeaDealerObj->phone = $request->phone;
        $becomeaDealerObj->state = $request->state;
        $becomeaDealerObj->district = $request->district;
        $becomeaDealerObj->village = $request->village;
        $becomeaDealerObj->intersted_in = $request->intersted_in;
        $becomeaDealerObj->save();
        return response()->json(['status' => 'true', 'message' => 'Form Submited successfully !']);
    }

    public function FindADealer(){
        $meta_title = "Find a Dealer - Laser Land Leveller Dealers Near You | Apogee Agrotech";
        $meta_keywords = "find laser land leveller dealer, apogee agrotech dealers, laser land leveller dealer near me, agricultural equipment dealer, precision farming equipment dealer, laser land leveller distributor";
        $meta_description = "Find authorized Apogee Agrotech dealers near you. Buy genuine Laser Land Leveller equipment from our network of trusted dealers across India. Search by location now.";
        $schema_type = 'WebPage';
        return view('admin.network.find-a-dealer', compact('meta_title', 'meta_keywords', 'meta_description', 'schema_type'));
    }

 public function SaveFindDealerForm(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            // 'state' => 'required',
            // 'district' => 'required',
        ]);

        $findADealer = new FindADealer();
        $findADealer->name = $request->name;
        $findADealer->email = $request->email;
        $findADealer->phone = $request->phone;
        $findADealer->state = $request->state;
        $findADealer->district = $request->district;
        $findADealer->save();


        // Query builder to match all available fields dynamically
        $query = Dealer::query();

        // if ($request->name) {
        //     $query->where('name', 'LIKE', '%' . $request->name . '%');
        // }
        // if ($request->email) {
        //     $query->where('email', $request->email);
        // }
        // if ($request->phone) {
        //     $query->where('phone', $request->phone);
        // }
        if ($request->state) {
            // $query->where('state', $request->state);
             $query->where('state', 'LIKE', '%' . $request->state . '%');
        }
        if ($request->district) {
            // $query->where('district', $request->district);
             $query->where('district', 'LIKE', '%' . $request->district . '%');
        }

        // Fetch matched dealers
        $dealers = $query->get();
        // dd($dealers);
        $html = view('admin.network.find-a-dealer-list', compact('dealers'))->render();
        // dd($firstImage, $productImage);
        return $html;

        // return response()->json(['status' => 'true', 'message' => 'Form Submited successfully !']);
    }


    public function testimonials(){
        $testimonials = Testimonial::where('status', 1)->latest()->get();
        
        $meta_title = "Customer Testimonials - Laser Land Leveller Reviews | Apogee Agrotech";
        $meta_keywords = "laser land leveller reviews, apogee agrotech testimonials, customer reviews, laser land leveller feedback, precision agriculture testimonials, agricultural equipment reviews, laser land leveller customer stories";
        $meta_description = "Read customer testimonials and reviews about Apogee Agrotech Laser Land Leveller equipment. Real experiences from farmers and agricultural professionals across India.";
        $schema_type = 'WebPage';
        return view('front.testimonials', compact('testimonials', 'meta_title', 'meta_keywords', 'meta_description', 'schema_type'));
    }


    public function Contactus()
    {
        $meta_title = "Contact Us - Laser Land Leveller Manufacturer | Apogee Agrotech";
        $meta_keywords = "contact apogee agrotech, laser land leveller contact, laser land leveller manufacturer contact, agricultural equipment inquiry, precision farming contact, laser land leveller support, apogee agrotech phone number";
        $meta_description = "Contact Apogee Agrotech for Laser Land Leveller inquiries, product information, dealer opportunities, and support. Call +91 7624002265 or email sales@apogeeagrotech.com. Located in Hapur, UP, India.";
        $schema_type = 'ContactPage';
        return view('front.contact-us', compact('meta_title', 'meta_keywords', 'meta_description', 'schema_type'));
    }

    public function saveContactForm(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'location' => 'required',
            // 'message' => 'required',
        ]);

        $enquiryObj = new Enquiry();
        $enquiryObj->name = $request->name;
        $enquiryObj->email = $request->email;
        $enquiryObj->phone = $request->phone;
        $enquiryObj->location = $request->location;
        $enquiryObj->message = $request->message;
        $enquiryObj->save();
        return response()->json(['status' => 'true', 'message' => 'Enquiry Submited successfully !']);
    }
    
    
    
    public function subscribe(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|unique:subscribes',
        ]);
        $subscribe = new Subscribe();
        $subscribe->email = $request->email;
        $subscribe->save();
        return response()->json(['message' => 'Subscription successful'], 200);
    }
    
    
     public function FarmerRegistration()
    {
        $state = DB::table('geo_locations')->where('location_type', 'STATE')->get();


        $meta_title = "Farmer Registration - Laser Land Leveller Owner Registration | Apogee Agrotech";
        $meta_keywords = "farmer registration, laser land leveller owner registration, agricultural equipment registration, farmer card registration, laser land leveller warranty registration";
        $meta_description = "Register your Laser Land Leveller equipment with Apogee Agrotech. Get farmer card, warranty benefits, and exclusive offers. Quick and easy registration process.";
        $schema_type = 'WebPage';
        return view('front.farmer-registration', compact('state', 'meta_title', 'meta_keywords', 'meta_description', 'schema_type'));
    }
    }


  public function loaddistrict(Request $req)
    {
        // dd($req->all());
        $sel = '';
        $StateId = $req->state_id;
        $districtDropdown  = '';
        $Distictlist = DB::table('geo_locations')->where('parent_id', $StateId)->where('location_type', 'DISTRICT')->get();

        // dd($Distictlist);
        if (count($Distictlist) > 0) {
            $districtDropdown  .= '<select class="form-control" name="district" onchange="setCity(this)" required>';
            $districtDropdown  .= '<option value="">जिला</option>';
            for ($i = 0; $i < count($Distictlist); $i++) {
                if (isset($sel) && $sel == $Distictlist[$i]->id) $selected = 'selected="selected"';
                else $selected = "";
                $districtDropdown  .= '<option data-id="' . $Distictlist[$i]->id . '" value="' . $Distictlist[$i]->name . '" ' . $selected . '>' . $Distictlist[$i]->name . '</option>';
            }
            // data-id="{{ $ste->id }}"
            $districtDropdown  .= '</select>';
        } else {
            $districtDropdown  .= '<select class="form-control" name="district" required>';
            $districtDropdown  .= '<option value="">No Record Found</option>';
            $districtDropdown  .= '</select>';
        }



        return response()->json([
            'districtDropdown' => $districtDropdown,
        ]);
    }

    public function loadcity(Request $req)
    {
        // dd($req->all());
        $sel = '';
        $cityId = $req->city_id;
        $cityDropdown  = '';
        $citylist = DB::table('geo_locations')->where('parent_id', $cityId)->where('location_type', 'SUBDISTRICT')->get();

        // dd($citylist);
        if (count($citylist) > 0) {
            $cityDropdown  .= '<select class="form-control" name="city" required>';
            $cityDropdown  .= '<option value="">शहर</option>';
            for ($i = 0; $i < count($citylist); $i++) {
                if (isset($sel) && $sel == $citylist[$i]->id) $selected = 'selected="selected"';
                else $selected = "";
                $cityDropdown  .= '<option value="' . $citylist[$i]->name . '" ' . $selected . '>' . $citylist[$i]->name . '</option>';
            }
            // data-id="{{ $ste->id }}"
            $cityDropdown  .= '</select>';
        } else {
            $cityDropdown  .= '<select class="form-control" name="city" required>';
            $cityDropdown  .= '<option value="">No Record Found</option>';
            $cityDropdown  .= '</select>';
        }



        return response()->json([
            'cityDropdown' => $cityDropdown,
        ]);
    }
    
    
      public function SaveFarmerRegistraion(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'name' => 'required',
            'phone' => 'required|digits:10|unique:farmer_registrations',
            'state' => 'required',
            'district' => 'required',
            'city' => 'required',
            // 'pin_code' => 'required|digits:6',
            'address' => 'required',
            'leveller_manufacturer' => 'required',
            'leveller_model_no' => 'required',
            'leveller_purchase_date' => 'required',
        ]);
          // Generate unique customer ID
        do {
            $customer_id = 'CUST' . mt_rand(100000, 999999); // e.g. CUST456789
        } while (FarmerRegistration::where('customer_id', $customer_id)->exists());

         // 16 digit ka unique card number generate karo
        do {
            $cardNumber = '';
            for ($i = 0; $i < 16; $i++) {
                $cardNumber .= mt_rand(0, 9);
            }
        } while (FarmerRegistration::where('card_number', $cardNumber)->exists());

        // Expiry date calculate karo (current month + 3 months)
        $expiryDate = Carbon::now()->addMonths(3)->endOfMonth(); 


        $farmerRegistration = new FarmerRegistration();
        $farmerRegistration->customer_id = $customer_id;
        $farmerRegistration->name = $req->name;
        $farmerRegistration->phone = $req->phone;
        $farmerRegistration->state = $req->state;
        $farmerRegistration->district = $req->district;
        $farmerRegistration->city = $req->city;
        $farmerRegistration->pin_code = $req->pin_code;
        $farmerRegistration->address = $req->address;
        $farmerRegistration->leveller_manufacturer = $req->leveller_manufacturer;
        $farmerRegistration->leveller_model_no = $req->leveller_model_no;
        $farmerRegistration->leveller_purchase_date = $req->leveller_purchase_date;
         $farmerRegistration->card_number = $cardNumber;
        $farmerRegistration->expiry_date = $expiryDate;
        $farmerRegistration->card_ganrate_status = 1;
        $farmerRegistration->save();
        $farmerCard = $farmerRegistration;
        // return response()->json(['status' => 'true', 'message' => 'Form Submited successfully !']);
        
         $html = view('front.layouts.include-find-afarmer-card', compact('farmerCard'))->render();
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }
    
      public function FindAfarmerCard()
    {
        $meta_title = "Find Farmer Card - Laser Land Leveller Owner Card Lookup | Apogee Agrotech";
        $meta_keywords = "find farmer card, laser land leveller owner card, farmer card lookup, agricultural equipment card, apogee agrotech farmer card";
        $meta_description = "Find your Laser Land Leveller farmer card by entering your details. Access warranty information, service history, and exclusive benefits from Apogee Agrotech.";
        $schema_type = 'WebPage';
        return view('front.find-a-farmer-card', compact('meta_title', 'meta_keywords', 'meta_description', 'schema_type'));
    }


    public function FindFarmerCardForm(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'phone' => 'required|digits:10',
        ]);

        // Query builder to match all available fields dynamically
        $query = FarmerRegistration::where('card_ganrate_status', 1);

        if ($request->name) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->phone) {
            $query->where('phone', $request->phone);
        }
        // Fetch matched dealers
        $farmerCard = $query->first();
        // dd($farmerCard);
        if ($farmerCard) {
            $html = view('front.layouts.include-find-afarmer-card', compact('farmerCard'))->render();
            return response()->json([
                'status' => true,
                'html' => $html
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Farmer card not found. Please check the name and phone number.'
            ]);
        }
    }
}
