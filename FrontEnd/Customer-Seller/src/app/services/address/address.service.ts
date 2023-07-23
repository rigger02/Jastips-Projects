import { Injectable } from '@angular/core';
import { AuthService } from '../auth/auth.service';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AddressService {

  constructor(
    private auth:AuthService,
    private http:HttpClient
  ) { }

  public GetUserAddressActive(){
    return this.http.get(environment.ApiURL+'api/user/getAddressActive',{headers : this.auth.jwt()});
  }
  
  public GetUserAddress(){
    return this.http.get(environment.ApiURL+'api/user/getAddress',{headers : this.auth.jwt()});
  }

  public CreateAddress(data:any){
    return this.http.post(environment.ApiURL+'api/user/addAddress',data,{headers : this.auth.jwt()});
  }

  public updateAddress(data:any){
    return this.http.put(environment.ApiURL+'api/user/editAddress/'+data.id_ttca, data, {headers : this.auth.jwt()});
  }
  
  public deleteAddress(id:any){
    return this.http.delete(environment.ApiURL+'api/deleteAddress/'+id);
  }

}
