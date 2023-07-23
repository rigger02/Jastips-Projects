import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { NavController } from '@ionic/angular';
import { ApiService } from '../services/api/api.service';
import { GlobalService } from '../services/global/global.service';

@Component({
  selector: 'app-order-detail',
  templateUrl: './order-detail.page.html',
  styleUrls: ['./order-detail.page.scss', '../../output.css'],
})

export class OrderDetailPage implements OnInit {
  id:any
  orders:any
  store = ''
  inv = ''
  phone = ''
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
    private router: Router,
    private global: GlobalService
  ) { }

  async ngOnInit() {
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
    this.phone = await this.formatPhoneNumber(this.phone)
    console.log(this.phone)
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
        this.phone = res[0].phone_ttca
        this.orders = res
        console.log(this.orders)
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

  takeOrder(){
    const formattedNumber = this.formatPhoneNumber(this.phone);
    console.log(formattedNumber);

    const link = "https://wa.me/"+formattedNumber+'?text=Halo%20kak%20'+this.customer+'%20apakah%20benar%20kakak%20memesan%20sesuatu%20dari%20toko%20'+this.store+'%3F%20Bisa%20kirimkan%20patokan%20rumahnya%20kak%20terima%20kasih'

    this.api.takeOrder(this.id).subscribe(
      (res:any) => {
        console.log(res)
        this.global.showAlert('Anda telah menerima pesanan, hubungi customer sekarang', 'Berhasil', [
          {
            text: 'Okay',
            handler: () => {
              window.open(link, "_system");
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

  formatPhoneNumber(phoneNumber: string): string {
    const countryCode = "62";
    const formattedPhoneNumber = phoneNumber.replace(/^0/, "");
    return countryCode + formattedPhoneNumber;
  }

  rupiah(val:any){
    return this.global.formatRupiah(val)
  }
  goBack() {
    this.router.navigate(['/tab2']);
  }

}

