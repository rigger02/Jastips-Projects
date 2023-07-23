import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { ApiService } from 'src/app/services/api/api.service';

@Component({
  selector: 'app-pesanan',
  templateUrl: './pesanan.page.html',
  styleUrls: ['./pesanan.page.scss'],
})
export class PesananPage implements OnInit {

  constructor(
    private api: ApiService,
    private navCtrl: NavController
  ) { }

  orders:any

  quantity:any

  ngOnInit() {
    this.GetDataOrder()
  }

  GetDataOrder(){
    this.api.getOrderStore().subscribe( (res:any)=>{
      this.orders = res['data']
      console.log(this.orders)
    })
  }

  rupiah(value){
    // Mengonversi angka menjadi format rupiah
    const formatter = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0,
    });

    return formatter.format(value);
  }

  orderDetail(id:any){
    this.navCtrl.navigateForward('/s-tabs/order-detail/'+id)
  }

}
