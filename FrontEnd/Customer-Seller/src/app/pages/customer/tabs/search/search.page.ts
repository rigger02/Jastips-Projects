import { Component, OnInit, ViewChild } from '@angular/core';
import { StoreService } from 'src/app/services/store/store.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.page.html',
  styleUrls: ['./search.page.scss'],
})
export class SearchPage implements OnInit {

  @ViewChild('searchInput') sInput;
  model: any = {
    icon: 'search-outline',
    title: 'No Restaurants Record Found'
  };
  isLoading: boolean;
  query: any;
  allRestaurants: any[] = [];

  restaurants: any[] = [];

  constructor(
    private store: StoreService
  ) { }

  ngOnInit() {
    setTimeout(() => {
      this.GetDataStore();
      this.sInput.setFocus();
    }, 500);

  }

  GetDataStore(){
    this.store.GetStore().subscribe( (res:any)=>{
      this.allRestaurants = res['data']
      console.log(this.allRestaurants)
    })
  }

  async onSearchChange(event) {
    console.log(event.detail.value);
    this.query = event.detail.value.toLowerCase();
    this.restaurants = [];
    if(this.query.length > 0) {
      this.isLoading = true;
      setTimeout(async() => {
        this.restaurants = await this.allRestaurants.filter((element: any) => {
          return element.name_tms.toLowerCase().includes(this.query);
        });
        console.log(this.restaurants);
        this.isLoading = false;
      }, 1500);
    }
  }

}
