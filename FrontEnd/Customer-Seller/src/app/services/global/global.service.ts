import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { AlertController, LoadingController, ModalController, ToastController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class GlobalService {

  isLoading: boolean = false

  constructor(
    private alertCtrl: AlertController,
    private toastCtrl: ToastController,
    private loadingtCtrl: LoadingController,
    private modalCtrl: ModalController,
    private router: Router
  ) { }

  showAlert(message: string, header?, buttonArray?){
    this.alertCtrl.create({
      header: header ? header : 'Authentication Failed',
      message: message,
      buttons: buttonArray ? buttonArray : ['Okay']
    })
    .then(alertEl => alertEl.present())
  }

  alertLogin(message?){
    this.showAlert(
      message ? message : "silahkan login terlebih dahulu",
      "Anda belum login",
      ["Kembali", 
      {
        text: 'Login',
        role: 'confirm',
        handler: () => {
          this.router.navigateByUrl("/onboard");
        },
      }]
      )
  }

  async showToast(msg, color, position, duration=3000){
    const toast = await this.toastCtrl.create({
      message: msg,
      duration: duration,
      color: color,
      position: position
    })
    toast.present();
  }

  errorToast(msg?, duration = 4000){
    this.showToast(msg ? msg : 'No Internet Connection', 'danger', 'bottom', duration)
  }

  successToast(msg){
    this.showToast(msg, 'success', 'bottom')
  }

  showLoader(msg?, spinner?){
    this.isLoading = true;
    return this.loadingtCtrl.create({
      message: msg,
      spinner: spinner ? spinner : 'bubbles'
    }).then(res => {
      res.present().then(() =>{
        if(this.isLoading){
          res.dismiss().then(() =>{
            console.log('abort presenting')
          });
        }
      })
    })
    .catch(e => {
      console.log("Loading Error", e);
    });
  }

  hideLoader(){
    this.isLoading = false;
    return this.loadingtCtrl.dismiss()
    .then(() => console.log("dismissed"))
    .catch(e => console.log("error hide loader: ", e));
  }

  async createModal(options) {
    const modal = await this.modalCtrl.create(options);
    await modal.present();
    const {data} = await modal.onWillDismiss();
    console.log(data);
    if(data) return data;
  }

  modalDismiss(val?){
    let data: any = val ? val : null;
    console.log('data: ', data)
    this.modalCtrl.dismiss(data)
  }

  formatRupiah(value){
      const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
      });
  
      return formatter.format(value);
  }

  reloadPrev(){
    window.history.back();
    setTimeout(() => {
      window.location.reload();
    },100); // Menambahkan jeda untuk memastikan halaman sebelumnya sudah ter-load kembali
  }

  
}
