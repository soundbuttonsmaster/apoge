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
        $meta_title = "About Us - Apogee Agrotech";
        $meta_keywords =  "About Us - Apogee Agrotech";
        $meta_description =  "About Us - Apogee Agrotech, Provides agri equipment at best prices.";
        return view('front.company.about-us', compact('meta_title', 'meta_keywords', 'meta_description'));
    }
     public function TimeLine()
    {
        $meta_title = "Timeline - Apogee Agrotech";
        $meta_keywords =  "Timeline - Apogee Agrotech";
        $meta_description =  "Timeline - Apogee Agrotech, Provides agri equipment at best prices.";
        return view('front.company.time-line', compact('meta_title', 'meta_keywords', 'meta_description'));
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


        $meta_title = @$subcategory->meta_title;
        $meta_keywords =  @$subcategory->meta_keywords;
        $meta_description =  @$subcategory->meta_description;
        $header_content = @$subcategory->head_content;
        return view('front.product-listing', compact('productlisting', 'category_name', 'subcategory_name', 'AllCategory', 'meta_title', 'meta_keywords', 'meta_description', 'header_content'));
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
        
         $meta_title = @$category->meta_title;
        $meta_keywords =  @$category->meta_keywords;
        $meta_description =  @$category->meta_description;
        $header_content = @$category->head_content;
        return view('front.product-listing', compact('productlisting', 'category_name', 'AllCategory', 'headerContent', 'meta_title', 'meta_keywords', 'meta_description', 'header_content'));
    }

     public function productDatels($product_slug)
    {
        $product = Product::where('slug', $product_slug)->where('status', 1)->first();
        if (!$product) {
            return redirect('404');
        }
        // dd($product);
        $RelatedProducts = Product::where('category_id', $product->category_id)->where('subcategory_id', $product->subcategory_id)->where('status', 1)->latest()->get();


        $meta_title = @$product->meta_title;
        $meta_keywords =  @$product->meta_keywords;
        $meta_description =  @$product->meta_description;
        $header_content = @$product->head_content;
        return view('front.product-datels', compact('product', 'RelatedProducts', 'meta_title', 'meta_keywords', 'meta_description', 'header_content'));
    }


    // Media
     public function ImageGallery()
    {
        $session = Session::where('status', 1)->get();
        $headerContent = HeaderContent::where('page_name', 'photo_gallery')->where('status', 1)->first();

        
        $meta_title = @$headerContent->meta_title;
        $meta_keywords =  @$headerContent->meta_keywords;
        $meta_description =  @$headerContent->meta_description;
        return view('front.media.image-gallery', compact('session', 'meta_title', 'meta_keywords', 'meta_description'));
    }

   public function VideoGallery(){
        $videoGallery = VideoGallery::where('status', 1)->latest()->get();
        $headerContent = HeaderContent::where('page_name', 'video_gallery')->where('status', 1)->first();

        $meta_title = @$headerContent->meta_title;
        $meta_keywords =  @$headerContent->meta_keywords;
        $meta_description =  @$headerContent->meta_description;
        return view('front.media.video-gallery', compact('videoGallery', 'meta_title', 'meta_keywords', 'meta_description'));
    }
    public function Blog(){
        $blog = Blog::where('status', 1)->latest()->get();
        return view('front.media.blog', compact('blog'));
    }
   public function BlogDatels($slug){
        // dd($slug);
        $blogdatels = Blog::where('slug', $slug)->where('status', 1)->first();
        if (!$blogdatels) {
            return redirect('404');
        }

        $blogs = Blog::where('status', 1)->latest()->take(5)->get();

        $meta_title = @$blogdatels->meta_title;
        $meta_keywords =  @$blogdatels->meta_keywords;
        $meta_description =  @$blogdatels->meta_description;
        $header_content = @$blogdatels->head_content;
        return view('front.media.blog-datels', compact('blogdatels', 'blogs', 'meta_title', 'meta_keywords', 'meta_description', 'header_content'));

    }
 
    // Network
    public function BecomeADealer(){
        $meta_title = "Become a Dealer - Apogee Agrotech";
        $meta_keywords =  "Become a Dealer - Apogee Agrotech";
        $meta_description =  "Become a Dealer - Apogee Agrotech, Provides agri equipment at best prices.";
        return view('admin.network.become-a-dealer', compact('meta_title', 'meta_keywords', 'meta_description'));
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
        $meta_title = "Find a Dealer - Apogee Agrotech";
        $meta_keywords =  "Find a Dealer - Apogee Agrotech";
        $meta_description =  "Find a Dealer - Apogee Agrotech, Provides agri equipment at best prices.";
        return view('admin.network.find-a-dealer', compact('meta_title', 'meta_keywords', 'meta_description'));
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
        
        $meta_title = "Testimonials - Apogee Agrotech";
        $meta_keywords =  "Testimonials - Apogee Agrotech";
        $meta_description =  "Testimonials - Apogee Agrotech, Provides agri equipment at best prices.";
        return view('front.testimonials', compact('testimonials', 'meta_title', 'meta_keywords', 'meta_description'));
    }


    public function Contactus()
    {
        $meta_title = "Contact Us - Apogee Agrotech";
        $meta_keywords =  "Contact Us - Apogee Agrotech";
        $meta_description =  "Contact Us - Apogee Agrotech, Provides agri equipment at best prices.";
        return view('front.contact-us', compact('meta_title', 'meta_keywords', 'meta_description'));
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


        $meta_title = "Farmer Registration - Apogee Agrotech";
        $meta_keywords =  "Farmer Registration - Apogee Agrotech";
        $meta_description =  "Farmer Registration - Apogee Agrotech, Provides agri equipment at best prices.";
        return view('front.farmer-registration', compact('state', 'meta_title', 'meta_keywords', 'meta_description'));
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
        return view('front.find-a-farmer-card');
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
