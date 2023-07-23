import { Component, Input, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { ApiService } from 'src/app/services/api/api.service';

@Component({
  selector: 'app-edit-address',
  templateUrl: './edit-address.component.html',
  styleUrls: ['./edit-address.component.scss'],
})
export class EditAddressComponent implements OnInit {

  constructor(
    private modalCtrl: ModalController,
    private api: ApiService
    ) {}

    @Input() id:any

    addresses:any

    form: any = {
      name_ttca: '',
      phone_ttca: '',
      static_ttca: '',
      dynamic_ttca: ''
    };

  
  ngOnInit() {
    this.getAddresses()
    console.log(this.id)
  }

  getAddresses() {    
    this.api.getUserAddress().subscribe(
      (res: any) => {
        const allAddresses = res['data'];
        const filteredAddresses = allAddresses.filter(address => address.id_ttca === this.id);
        
        if (filteredAddresses.length > 0) {
          this.form = filteredAddresses[0];
          console.log(this.form);
        }
      }
    );
  }

  


  cancel() {
    return this.modalCtrl.dismiss(null, 'cancel');
  }

  confirm() {
    return this.modalCtrl.dismiss(this.form, 'confirm');
  }

}
