import { Injectable } from '@angular/core';
import { AuthService } from '../auth/auth.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ProductService {

  

  constructor(
    private http:HttpClient,
    private auth:AuthService
    ) { }

  public productByStore(id:any){
    return this.http.get(environment.ApiURL+'api/product/'+id);
  }

  public productStore(){
    return this.http.get(environment.ApiURL+'api/seller/productStore',{headers : this.auth.jwt()})
  }

  public createProduct(data:any){
    return this.http.post(environment.ApiURL+'api/seller/createProduct', data, {headers : this.auth.jwt()});
  }

  public deleteProduct(id:any){
    return this.http.delete(environment.ApiURL+'api/seller/deleteProduct/'+id,{headers : this.auth.jwt()});
  }

  public publish(id:any){
    return this.http.put(environment.ApiURL+'api/seller/publishProduct/'+id,'',{headers : this.auth.jwt()});
  }

  public unpublish(id:any){
    return this.http.put(environment.ApiURL+'api/seller/unpublishProduct/'+id,'',{headers : this.auth.jwt()});
  }
}
