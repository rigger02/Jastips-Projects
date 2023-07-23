import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { NavController } from '@ionic/angular';
import { ApiService } from 'src/app/services/api/api.service';
import { GlobalService } from 'src/app/services/global/global.service';

@Component({
  selector: 'app-order-detail',
  templateUrl: './order-detail.page.html',
  styleUrls: ['./order-detail.page.scss'],
})
export class OrderDetailPage implements OnInit {

  id:any
  orders:any
  store = ''
  inv = ''
  customer = ''
  cAddress = ''
  sAddress = ''
  status = ''
  date = ''
  time = ''
  ongkir = 15000
  harga = 0
  total = 0

  constructor(
    private route: ActivatedRoute,
    private navCtrl: NavController,
    private api: ApiService,
    private global: GlobalService,


  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe(paramMap => {
      console.log('data: ', paramMap);
      if(!paramMap.has('id')) {
        this.navCtrl.back();
        return;
      }
      this.id = paramMap.get('id');
      console.log('id: ', this.id);
    });
    this.getOrderDetail();
  }

  getOrderDetail(){
    this.api.getOrderDetail(this.id).subscribe(
      (res:any) => {
        this.store = res[0].name_tms
        this.inv = res[0].transaction_ttop
        this.customer = res[0].name_ttca
        this.cAddress = res[0].static_ttca + ', ' + res[0].dynamic_ttca
        this.sAddress = res[0].address_tms
        this.status = res[0].status_ttop
        this.date = res[0].date
        this.time = res[0].time
        this.orders = res
        console.log(this.cAddress)
         // Menghitung harga
        this.harga = 0;
        for (let order of this.orders) {
          this.harga += order.price_ttps * order.qty_ttop;
        }

        // Menambahkan ongkir ke total
        this.total = this.harga + this.ongkir;

        console.log("Harga:", this.harga);
        console.log("Total:", this.total);
      }
    )
  }

  async takeOrder(){
    this.api.takeOrder(this.id).subscribe(
      (res:any) => {
        console.log(res)
        this.global.showAlert('Anda telah menerima pesanan, chat customer sekarang', 'Berhasil', [
          {
            text: 'Okay',
            handler: () => {
              this.global.showLoader('','bubbles')
              this.getOrderDetail()
            }
          }
        ])
      },
      error =>{
        this.global.showAlert('Terjadi kesalahan', 'Gagal')
        console.log(error)
      }
    )
  }

  refusemOrder(){

  }

  rupiah(val){
    return this.global.formatRupiah(val)
  }



}
