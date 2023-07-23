import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { Preferences } from '@capacitor/preferences';
import { IonContent, NavController } from '@ionic/angular';
import { ApiService } from 'src/app/services/api/api.service';
import { GlobalService } from 'src/app/services/global/global.service';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.page.html',
  styleUrls: ['./cart.page.scss'],
})
export class CartPage implements OnInit {

  @ViewChild(IonContent, {static: false}) content: IonContent;
  urlCheck: any;
  url: any;
  model: any = {};
  deliveryCharge = 13000;
  instruction: any = '';
  location: any = {};
  product_ttop:any = [];

  carts:any[] = [];

  constructor(
    private router: Router,
    private api: ApiService,
    private navCtrl: NavController,
    private http: HttpClient,
    private global: GlobalService
  ) { }

  ngOnInit() {
    this.getUserAddressActive()
    this.checkUrl();
    this.getModel();
  }

 

  getUserAddressActive(){
    this.api.getUserAddressActive().subscribe( (res:any)=>{
      if(!res){
        return
      }
      this.model.address = res
      console.log('this Address', this.model.address)
    })
  }


  getCart() {
   return Preferences.get({key: 'cart'});
  }

  async getModel() {
    let data: any = await this.getCart();
    // this.location = {
    //   lat: 28.653831, 
    //   lng: 77.188257, 
    //   address: 'Karol Bagh, New Delhi'
    // };
    if(data?.value) {
      this.model = await JSON.parse(data.value);
      console.log('getModel: ',this.model);
      this.calculate();
    }
  }

  async calculate() {
    let item = this.model.productStore.filter(x => x.quantity > 0);
    this.model.productStore = item;
    this.model.totalPrice = 0;
    this.model.totalProduct = 0;
    this.model.deliveryCharge = 0;
    this.model.grandTotal = 0;
    item.forEach(element => {
      this.model.totalProduct += element.quantity;
      this.model.totalPrice += (parseFloat(element.price_ttps) * parseFloat(element.quantity));
    });
    this.model.deliveryCharge = this.deliveryCharge;
    this.model.totalPrice = parseFloat(this.model.totalPrice);
    this.model.grandTotal = (parseFloat(this.model.totalPrice) + parseFloat(this.model.deliveryCharge));
    if(this.model.totalProduct == 0) {
      this.model.totalProduct = 0;
      this.model.totalPrice = 0;
      this.model.grandTotal = 0;
      await this.clearCart();
      this.model = null;
    }
    console.log('cart: ', this.model);
  }

  clearCart() {
    return Preferences.remove({key: 'cart'});
  }

  checkUrl() {
    let url: any = (this.router.url).split('/');
    console.log('url: ', url);
    const spliced = url.splice(url.length - 2, 2); // /tabs/cart url.length - 1 - 1
    this.urlCheck = spliced[0];
    console.log('urlcheck: ', this.urlCheck);
    url.push(this.urlCheck);
    this.url = url;
    console.log(this.url);
  }

  
  reloadPrev() {
    this.global.reloadPrev()
  }

  getPreviousUrl() {
    return this.url.join('/');
  }

  async quantityPlus(index) {
    try {
      console.log(this.model.productStore[index]);
      if(!this.model.productStore[index].quantity || this.model.productStore[index].quantity == 0) {
        this.model.productStore[index].quantity = 1;
        this.calculate();
      } else {
        this.model.productStore[index].quantity += 1; // this.model.items[index].quantity = this.model.items[index].quantity + 1
        this.calculate();
      }
    await this.saveToCart()
    } catch(e) {
      console.log(e);
    }
  }

  async quantityMinus(index) {
    if(this.model.productStore[index].quantity !== 0) {
      this.model.productStore[index].quantity -= 1; // this.model.productStore[index].quantity = this.model.productStore[index].quantity - 1
    } else {
      this.model.productStore[index].quantity = 0;
    }
    this.calculate();
    await this.saveToCart()

  }

  async saveToCart(){
    try {
      console.log('cartData', this.model);
      // localStorage.setItem('cart', JSON.stringify(this.cartData));
      await Preferences.set({
        key: 'cart',
        value: JSON.stringify(this.model)
      });
       // Tambahkan kode berikut untuk menghapus data keranjang dari penyimpanan preferensi jika tidak ada produk tersisa
    } catch(e) {
      console.log(e);
    }
  }

  addAddress() {
    this.navCtrl.navigateForward('/c-tabs/address')
  }

  changeAddress() {}

  async makeOrder() {
    if(!this.model.address){
      this.global.showAlert('Alamat tidak boleh kosong!', 'Gagal')
    }else {

      try {
        this.model.productStore.forEach(element => {
          const product = {
            qty_ttop: element.quantity,
            description_ttop: this.instruction,
            id_ttps: element.id_ttps
          };
          this.product_ttop.push(product);
        });
        
        const jsonResponse = JSON.stringify(this.product_ttop)

        const response = await this.api.addOrder({'product_ttop': jsonResponse}).subscribe(
          (res:any) => {
            this.global.showAlert("Pesanan berhasil dibuat", 'Berhasil', [
              {
                text: 'Batal',
                role: 'cancel',
                cssClass: 'secondary',
                handler: () => {
                  // Aksi yang akan diambil jika pengguna memilih "Batal"
                }
              },
              {
                text: 'Okay',
                handler: async () => {
                  this.global.showLoader()
                  await this.clearCart()
                  await this.navCtrl.navigateForward('/c-tabs/orders')
                }
              }
            ])
          },
          error => {
            console.log("error: ", error)
          }
        )
    
          if(response){
          
         
        }
    
        console.log('order', this.product_ttop);
      } catch(e) {
        console.log(e);
      }
    }
  }

  scrollToBottom() {
    this.content.scrollToBottom(500);
  }

  rupiah(value){
    return this.global.formatRupiah(value)
  }

}
