import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/services/api/api.service';

@Component({
  selector: 'app-orders',
  templateUrl: './orders.page.html',
  styleUrls: ['./orders.page.scss'],
})
export class OrdersPage implements OnInit {

  constructor(
    private api: ApiService
  ) { }

  orders:any[]=[]

  ngOnInit() {
    this.GetDataOrder()
  }

  GetDataOrder(){
    this.api.getOrder().subscribe( (res:any)=>{
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

}
