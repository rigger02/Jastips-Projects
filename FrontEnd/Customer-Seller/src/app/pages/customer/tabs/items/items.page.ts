import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { AlertController, NavController } from '@ionic/angular';
import { Preferences } from '@capacitor/preferences';
import { ApiService } from 'src/app/services/api/api.service';
import { GlobalService } from 'src/app/services/global/global.service';

@Component({
  selector: 'app-items',
  templateUrl: './items.page.html',
  styleUrls: ['./items.page.scss'],
})
export class ItemsPage implements OnInit {

  id: any;
  data: any = {};
  items: any[] = [];
  veg: boolean = false;
  isLoading: boolean;
  cartData: any = {};
  storedData: any = {};
  model = {
    icon: 'fast-food-outline',
    title: 'No Menu Available'
  };

  carts:any[] = [];

  productStore:any[] = [];
  stores:any = {};

  constructor(
    private api: ApiService,
    private navCtrl: NavController,
    private route: ActivatedRoute,
    private router: Router,
    private global: GlobalService
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe(paramMap => {
      console.log('data: ', paramMap);
      if(!paramMap.has('restaurantId')) {
        this.navCtrl.back();
        return;
      }
      this.id = paramMap.get('restaurantId');
      console.log('id: ', this.id);
    });
    this.getProductByStore();
    this.GetDataStore()
    this.getData();
  }

  GetDataStore(){
    this.api.getStoreById(this.id).subscribe( (res:any)=>{
      this.stores = res
      console.log('store: ',this.stores)
    })
  }

  getProductByStore(){
    this.api.productByStore(this.id).subscribe( (res:any) =>{
      this.productStore = res['data']
      console.log('product: ',this.productStore)
    })
  }


  getCart() {
    return Preferences.get({key: 'cart'});
  }

  async getData() {
    this.isLoading = true;
    this.data = {};
    this.cartData = {};
    this.storedData = {};
    setTimeout(async() => {      
      let data: any = this.stores;
      this.data = data;
  //     this.categories = this.categories.filter(x => x.uid === this.id );
  //     this.items = this.allItems.filter(x => x.uid === this.id);
      console.log('restaurant: ', this.data);
      let cart: any = await this.getCart();
      console.log('cart: ', cart);
      if(cart?.value) {
        this.storedData = JSON.parse(cart.value);
        console.log('storedData: ', this.storedData);
        if(this.id == this.storedData.store.id_tms && this.productStore.length > 0) {
          this.productStore.forEach((element: any) => {
            this.storedData.productStore.forEach(ele => {
              if(element.id_ttps != ele.id_ttps) return;
              element.quantity = ele.quantity;
            })
          })
        }
        this.cartData.totalProduct = this.storedData.totalProduct;
        this.cartData.totalPrice = this.storedData.totalPrice;
      }
      this.isLoading = false;
    }, 1500);
  }

  // vegOnly(event) {
  //   console.log(event.detail.checked);
  //   this.items = [];
  //   if(event.detail.checked == true) this.items = this.allItems.filter(x => x.veg === true);
  //   else this.items = this.allItems;
  //   console.log('items: ', this.items);
  // }

  async quantityPlus(index) {
    let token = localStorage.getItem('token');
    if(!token){
      this.global.alertLogin("Silahkan Login terlebih dahulu untuk pesan makanan")
      }else{
        try {
          // console.log(this.productStore[index]);
          if(!this.productStore[index].quantity || this.productStore[index].quantity == 0) {
            this.productStore[index].quantity = 1;
          } else {
            this.productStore[index].quantity += 1; // this.productStore[index].quantity = this.productStore[index].quantity + 1
          }
          this.calculate();
          await this.saveToCart()
        } catch(e) {
          console.log(e);
        }
      }
  }

  async quantityMinus(index) {
    if(this.productStore[index].quantity !== 0) {
      this.productStore[index].quantity -= 1; // this.productStore[index].quantity = this.productStore[index].quantity - 1
    } else {
      this.productStore[index].quantity = 0;
    }
    this.calculate();
    await this.saveToCart()
  }
  


  async calculate() {
    console.log(this.productStore);
    this.cartData.productStore = [];
    let product = this.productStore.filter(x => x.quantity > 0);
    console.log('added productStore: ', product);
    this.cartData.productStore = product;
    this.cartData.totalPrice = 0;
    this.cartData.totalProduct = 0;
    product.forEach(element => {
      this.cartData.totalProduct += element.quantity;
      this.cartData.totalPrice += (parseFloat(element.price_ttps) * parseFloat(element.quantity));
    });
    this.cartData.totalPrice = parseFloat(this.cartData.totalPrice);
    if(this.cartData.totalProduct == 0) {
      this.cartData.totalProduct = 0;
      this.cartData.totalPrice = 0;
    await this.saveToCart 
      // this.cartData = {}
    }
    console.log('cart: ', this.cartData);
  }

  async saveToCart() {
    try {
      this.cartData.store = {};
      this.cartData.store = this.stores;
      console.log('cartData', this.cartData);
      // localStorage.setItem('cart', JSON.stringify(this.cartData));
      await Preferences.set({
        key: 'cart',
        value: JSON.stringify(this.cartData)
      });
       // Tambahkan kode berikut untuk menghapus data keranjang dari penyimpanan preferensi jika tidak ada produk tersisa
    if (this.cartData.productStore.length === 0) {
      await Preferences.remove({ key: 'cart' });
    }
    } catch(e) {
      console.log(e);
    }
  }

  async viewCart() {
    if(this.cartData.productStore && this.cartData.productStore.length > 0) await this.saveToCart();
    console.log('router url: ', this.router.url);
    this.router.navigate([this.router.url + '/cart']);
  }
  
  rupiah(val){
    return this.global.formatRupiah(val)
  }




  

  

}
