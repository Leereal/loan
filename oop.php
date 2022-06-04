<?php
// declare(strict_types=1); //If I want strictness on my type declarations
// //Constructor 
// class Person {

//     //Constructor property promotion
//     public function __construct(public $name,public $surname)
//     {              
//     }    

//     public function fullname(){
//         return $this->name." ".$this->surname."\n";
//     }


// }
//     $student = new Person(name:"Liberty",surname:"Mutabvuri");


// if(is_iterable($student->fullname())){
//     print $student->fullname();
// }


// //Strict scalar type declaration which can be done on client file


// class ShopProduct
// {
//     public function __construct(   
//         public string $title,
//         public string $producerFirstName,
//         public string $producerMainName,
//         public float $price
//         ) {
//             $this->title = $title;
//             $this->title = $producerFirstName;
//             $this->title = $producerMainName;
//             $this->title = $price;
//         }
//         public function getProducer() :string | null{
//             return $this->producerFirstName. " " .$this->producerMainName;
//         }
//         public function getSummaryLine(): string
//         {
//             $base = "{$this->title} ( {$this->producerMainName}, ";
//             $base .= "{$this->producerFirstName} )";
//             return $base;
//         }
// }
//  interface ShoutOut{
//      public function shout();
//  }
// class ShopProductWriter{
    
//     public function write(ShopProduct $shopProduct){
//         print  $shopProduct->title . ": ". $shopProduct->getProducer(). " (" . $shopProduct->price . ")\n";
//     }

//     public function setDiscount($p) :void{
//          $this->discount = $p - 2;
//     }
// }

// class CdProduct extends ShopProduct implements ShoutOut
// {
//     public function __construct(
//         public string $title,
//         public string $producerFirstName,
//         public string $producerMainName,
//         public float $price,       
//         public float $playLength
//     ){
//         parent::__construct($title,$producerFirstName,$producerMainName,$price);
//         $this->playLength = $playLength;
//     }

//     public function shout(){
//         print "Hey I am a CD";
//     }

//     public function getPlayLength(): int
//     {
//         return $this->playLength;
//     }
//     public function getSummaryLine(): string
//     {
//         $base = parent::getSummaryLine();
//         $base .= ": playing time - {$this->playLength}";
//         return $base;
//     }    
// }

// class BookProduct extends ShopProduct{
    
//     public function __construct(
//         public string $title,
//         public string $producerFirstName,
//         public string $producerMainName,
//         public float $price,
//         public float $numPages
//     ){
//         parent::__construct($title,$producerFirstName,$producerMainName,$price);
//         $this->numPages = $numPages;
//     }
//     public function getNumberOfPages() :int{
//         return $this->numPages;
//     }
//     public function getSummaryLine(): string
//     {
//         $base = parent::getSummaryLine();
//         $base .= ": Number of Pages - {$this->numPages}";
//         return $base;        
//     }
// }
// $product2 = new CdProduct(title:"My Antonia", producerFirstName:"Willa", producerMainName:"Cather", price:5.99, playLength:20);
// $product2->shout();

// print "artist: {$product2->getSummaryLine()}\n";  

// class Conf{
//     private \SimpleXMLElement $xml;
//     private \SimpleXMLElement $lastmatch;
//     public function __construct(private string $file)
//     {
//         if(!file_exists($file)){
//             throw new Exception("File '{$file}' does not exist");
//         }
//         $this->xml = simplexml_load_file($file);
//     }

//     public function write() :void{
//         if(!is_writable($this->file)){
//             throw new Exception("File '{$this->file}' is not writable"); 
//         }
//         print "This file '{$this->file}' is apparently writable";
//         file_put_contents($this->file, $this->xml->asXML());
//     }    

//     public function get( string $str) :?string{
//         $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
//         if(count($matches)){
//             $this->lastmatch = $matches[0];
//             return (string) $matches[0];
//         }
//         return null;
//     }

//     public function set(string $key, string $value) :void{
//         if(!is_null($this->get($key))){
//             $this->lastmatch[0] = $value;
//         }
//         return;
//         $conf = $this->xml->conf;
//         $this->xml->addChild('item',$value)->addAttribute('name',$key);
//     }
// }

// try {
//     $conf = new Conf("/bookstore.xml");
//     //$conf = new Conf( "/root/unwriteable.xml" );
//     //$conf = new Conf( "nonexistent/not_there.xml" );
//     print "user: " . $conf->get('user') . "\n";
//     print "host: " . $conf->get('host') . "\n";
//     $conf->set("pass", "newpass");
//     $conf->write();
// }
// catch (Exception $e) {
//     throw new Exception("Conf error: " . $e->getMessage());
// }

// function divide($dividend, $divisor) {
//   if($divisor == 0) {
//     throw new Exception("Message",303);
//   }
//   return $dividend / $divisor;
// }
// try{
//     echo divide(5, 0);
// }catch(Exception $e){
//     echo $e->getTrace();
// }

// class Product{
//     public function __construct(public string $name, public float $price)
//     {
        
//     }
// }

// class ProcessSale{
//     private array $callbacks;
//     public function registerCallback(callable $callback) :void{
//         $this->callbacks[] = $callback;
//     }

//     public function sale(Product $product) :void{
//         print "{$product->name} : processing ";
//         foreach($this->callbacks as $callback){
//             call_user_func($callback,$product);
//         }
//     }
// }

// class Mailer{
//     public function doMail(Product $product) :void{
//         print " mailing ({$product->name}) \n";
//     }
// }

// //;$logger = fn($product)=>print "logging({$product->name}) \n";

// $processor = new ProcessSale();
// $processor->registerCallback([new Mailer(),'doMail']);
// $processor->sale(new Product("shoes",6));
// print"\n";
// $processor->sale(new Product("coffee",3));

$status = 5;

$statusValue = match($status){1=>"Active",0=>"Not active", default => "Not valid"};
echo $statusValue;