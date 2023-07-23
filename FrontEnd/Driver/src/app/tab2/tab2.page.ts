import { Component, NgModule, OnInit } from '@angular/core';
import { AlertController } from '@ionic/angular';
import { ApiService } from '../services/api/api.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-tab2',
  templateUrl: './tab2.page.html',

})
export class Tab2Page implements OnInit{
  constructor(
    private alertController: AlertController,
    private api: ApiService,
    private router: Router
    ) {}

    ngOnInit(): void {
        this.getOrderReady()
    }

    orders:any[] =[]


  orderDetail(id:any){
    this.router.navigateByUrl('/tabs/order-detail/'+id)
  }

  async yesorno() {
    const alert = await this.alertController.create({
      header: 'Konfirmasi',
      message: 'Apakah anda yakin ingin mengantar pesanan ini, dan mengubah status pesanan menjadi proses?',
      buttons: [
        {
          text: 'Batal',
          role: 'cancel',
          cssClass: 'secondary',
          handler: () => {
            console.log('Dibatalkan');
          },
        },
        {
          text: 'Ya',
          handler: () => {
            console.log('Diterima');
          },
        },
      ],
    });

    await alert.present();
  }
  async yesorno2() {
    const alert = await this.alertController.create({
      header: 'Konfirmasi',
      message: 'Apakah anda yakin ingin mengubah status pesanan menjadi sedang diantar?',
      buttons: [
        {
          text: 'Batal',
          role: 'cancel',
          cssClass: 'secondary',
          handler: () => {
            console.log('Dibatalkan');
          },
        },
        {
          text: 'Ya',
          handler: () => {
            console.log('Diterima');
          },
        },
      ],
    });

    await alert.present();
  }

  getOrderReady(){
    this.api.getOrderReady().subscribe((res:any) => {
      this.orders = res['data']
      console.log(this.orders)
    })
}}
