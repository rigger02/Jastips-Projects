import { Component, OnInit, ViewChild } from '@angular/core';
import { IonModal } from '@ionic/angular';
import { AddAddressComponent } from 'src/app/components/modals/add-address/add-address.component';
import { EditAddressComponent } from 'src/app/components/modals/edit-address/edit-address.component';
import { ApiService } from 'src/app/services/api/api.service';
import { GlobalService } from 'src/app/services/global/global.service';

@Component({
  selector: 'app-address',
  templateUrl: './address.page.html',
  styleUrls: ['./address.page.scss'],
})
export class AddressPage implements OnInit {

  @ViewChild(IonModal) modal: IonModal;

  isLoading: boolean;
  addresses: any[];

  form:any = {
  }

  constructor(
    private api: ApiService,
    private global: GlobalService
  ) { }

  ngOnInit() {
    this.getAddresses();
  }

  cancel() {
    this.modal.dismiss(null, 'cancel');
    this.form.name_ttps = ''
    this.form.phone_ttps = ''
    this.form.static_ttps = ''
    this.form.dynamic_ttps = ''
  }

  getAddresses() {    
    this.isLoading = true;
    setTimeout(() => {
      this.api.getUserAddress().subscribe(
        (res:any) => {
          this.addresses = res['data']
          console.log(res['data'])
        }
      )
      this.isLoading = false;
    }, 1000);

    // console.log(this.addresses)
  }

  reloadPrev() {
    this.global.reloadPrev()
  }

  async addAddress(){
    try{
      const options = {
        component: AddAddressComponent,
        swipeToClose: true
      };
      const address = await this.global.createModal(options)
      if(address){
        this.api.createAddress(address).subscribe(
          async (res:any) => {
            this.global.showLoader()
            console.log("Success: ", res)
            this.getAddresses()
          },async (error) =>{
            this.global.showAlert('Tambah Alamat gagal periksa kembali', "Gagal")
            console.log("Gagal: ", error)
          }
        )
      }
      
    } catch(e) {
      console.log(e)
    }


  }

  async editAddress(id) {
    try{
      const options = {
        component: EditAddressComponent,
        swipeToClose: true,
        componentProps: {
          id: id
        }
      };
      const address = await this.global.createModal(options)
      console.log(address.id_ttca)
      if(address){
        this.api.updateAddress(address).subscribe(
          async (res:any) => {
            this.global.showLoader()
            console.log("Success: ", res)
            this.getAddresses()
          },(error) =>{
            this.global.showAlert('Ubah Alamat gagal periksa kembali', "Gagal")
            console.log("Gagal: ", error)
          }
        )
      }
      
    } catch(e) {
      console.log(e)
    }
  }

  deleteAddress(id:any) {
    try{
      this.global.showAlert("Apakah anda yakin ingin menghapus alamat ini?", "Konfirmasi",[
        {
          text: "Batal",
          role: "cancel",
          handler: ()=> {

          }
        },
        {
          text: "Hapus",
          handler:() => {
            this.api.deleteAddress(id).subscribe((res:any) => {
              this.global.showLoader()
              this.global.showAlert("Alamat berhasil dihapus", 'Berhasil')
              this.getAddresses()
            },(error:any) => {
              console.log(error)
            })
          }
        }
      ])
    }catch(e) {
      throw(e)
    }
  }

}
