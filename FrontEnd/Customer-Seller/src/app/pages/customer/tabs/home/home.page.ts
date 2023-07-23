import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Preferences } from '@capacitor/preferences';
import { AlertController, NavController } from '@ionic/angular';
import { ApiService } from 'src/app/services/api/api.service';
import { StoreService } from 'src/app/services/store/store.service';


@Component({
  selector: 'app-home',
  templateUrl: './home.page.html',
  styleUrls: ['./home.page.scss'],
})
export class HomePage implements OnInit {

  banners: any[] = [];
  stores: any[] = [];
  isLoading: boolean = false;

  storedData: any = {}

  constructor(
    private router : Router,
    private api: ApiService,
    private navCtrl: NavController,
    private alertCtrl: AlertController,
  ) { }

  ngOnInit() {
    let role = localStorage.getItem("role")
    if(role == 'store'){
      this.router.navigateByUrl('/s-tabs')
    }
    this.isLoading = true;
    setTimeout(() => {
      this.banners = [  
        {banner: 'assets/imgs/1.jpg'},
        {banner: 'assets/imgs/2.jpg'},
        {banner: 'assets/imgs/3.jpg'}  
      ];
      this.GetDataStore();
      this.isLoading = false;
    }, 1500);
    
  }

GetDataStore(){
    this.api.getStore().subscribe( (res:any)=>{
      this.stores = res['data']
      console.log(this.stores)
    })
  }

  getCart(){
    return Preferences.get({key: 'cart'});
  }

  async storeDetail(id:any){
    let cart: any = await this.getCart();
      console.log('cart: ', cart);
      if(cart?.value) {
        this.storedData = JSON.parse(cart.value);
        console.log('storedData: ', this.storedData);
        if(id != this.storedData.store.id_tms){
          this.confirmDelete(id)
        }else {
          this.navCtrl.navigateForward('/c-tabs/restaurants/'+id)
        }
      }else{
        this.navCtrl.navigateForward('/c-tabs/restaurants/'+id)
      }
  }

  async confirmDelete(id:any) {
    const alert = await this.alertCtrl.create({
      header: 'Konfirmasi',
      message: 'Ada produk yang belum di checkout dari toko lain, mau ganti toko aja?',
      buttons: [
        {
          text: 'Batal',
          role: 'cancel',
          cssClass: 'secondary',
          handler: () => {
            // Aksi yang akan diambil jika pengguna memilih "Batal"
          }
        },
        {
          text: 'Ganti',
          handler: async () => {
            await Preferences.remove({ key: 'cart' });
            this.navCtrl.navigateForward('/c-tabs/restaurants/'+id)
          }
        }
      ]
    });
  
    await alert.present();
  }
}
