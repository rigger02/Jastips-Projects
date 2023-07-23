import { Component, OnInit, ViewChild } from '@angular/core';
import { Camera, CameraResultType, CameraSource } from '@capacitor/camera';
import { Capacitor } from '@capacitor/core';
import { IonModal } from '@ionic/angular';
import { ApiService } from 'src/app/services/api/api.service';
import { GlobalService } from 'src/app/services/global/global.service';
import { ProductService } from 'src/app/services/product/product.service';

@Component({
  selector: 'app-produk',
  templateUrl: './produk.page.html',
  styleUrls: ['./produk.page.scss'],
})
export class ProdukPage implements OnInit {

  @ViewChild(IonModal) modal: IonModal;

  constructor(
    private api: ApiService,
    private global: GlobalService,
  ) {}

  form = {
    name_ttps : '',
    price_ttps : '',
    image_ttps : '',
  }

  image_ttps :any;
  data:any ={}
  name:string

  productStore:any[] = [];



  ngOnInit() {
    this.getProductStore();
  }

  getProductStore(){
    this.api.productStore().subscribe( (res:any) =>{
      this.productStore = res['data']
      console.log('product: ', this.productStore)
    })
  }

  cancel() {
    this.modal.dismiss(null, 'cancel');
    this.data = {}
    this.form.name_ttps = ''
    this.form.price_ttps = ''
  }

  getFile(event: any){
    this.image_ttps = event.target.files[0];
    console.log('file', this.image_ttps)
  }

  

  checkPlatWeb(){
    if(Capacitor.getPlatform() == 'web') return true;
    return false;
  }

  async getPicture(){
    const image = await Camera.getPhoto({
      quality: 90,
      source: CameraSource.Photos,
      resultType: CameraResultType.Base64
    });

    
    this.data.name_ttps = this.form.name_ttps
    this.data.price_ttps = this.form.price_ttps
    this.data.image_ttps = 'data:image/jpeg;base64,' + image.base64String;
    
    console.log('data: ', this.data)
    
    // this.uploadImage(this.image_ttps);
  }

  async uploadProduct() {

    this.global.showLoader('','bubbles')

    await this.api.createProduct(this.data).subscribe(
      response => {
        this.getProductStore()
        this.data = {}
        this.form.name_ttps = ''
        this.form.price_ttps = ''
        this.modal.dismiss();
        console.log("Berhasil", response)
      },
      error => {
        this.global.showAlert("Data belum lengkap", "Gagal")
        console.log("gagal", error)
      }
    )
  }

  editProduct(){
    
  }
  
  async deleteProduct(id){

    this.global.showAlert('Apakah anda yakin ingin menghapus produk ini?', 'Konfirmasi',
    [
      {
        text: 'Batal',
        role: 'cancel',
        cssClass: 'secondary',
        
      },
      {
        text: 'Hapus',
        handler: async () => {
          this.global.showLoader('','bubbles')
    
          this.api.deleteProduct(id).subscribe((res:any) => {
            this.getProductStore()
            console.log("Berhasil", res)
            this.global.showAlert("Product berhasil dihapus", "Berhasil")
          },
          error =>{
            this.global.showAlert("Product gagal dihapus", "Gagal")
              console.log("gagal", error)
          })
        }
      }
    ])
  }

  publish(id:any){
    this.api.publish(id).subscribe(
      (res:any) => {
        this.global.showAlert('Produk berhasil di Publish', 'Berhasil',[
          {
            text: 'Okay',
            handler: () => {
              this.global.showLoader('','bubbles')
              this.getProductStore()
            }
          }
        ])
        console.log("Success", res)
      },(error:any)=>{
        console.log("Success", error)
      }
    )
  }

  unpublish(id:any){
    this.api.unpublish(id).subscribe(
      (res:any) => {
        this.global.showAlert('Produk berhasil di unpublish', 'Berhasil', [
          {
            text: 'Okay',
            handler: () => {
              this.global.showLoader('','bubbles')
              this.getProductStore()
            }
          }
        ])
        console.log("Success", res)
      },(error:any)=>{
        console.log("Error", error)
      }
    )
  }

  rupiah(val){
    return this.global.formatRupiah(val)
  }

}
