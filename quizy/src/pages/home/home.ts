import { Component, ViewChild, ElementRef } from '@angular/core';
import { NavController } from 'ionic-angular';
import { LocationTrackerProvider } from '../../providers/location-tracker/location-tracker';
import { Geolocation } from '@ionic-native/geolocation';
import L from 'leaflet';
import {HttpClient} from '@angular/common/http';



@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  @ViewChild('map')mapContainer : ElementRef;
  map : L.map;  
  center : any;
  marker : any;
  circle : any;

  public n = [];
  public e = [];
  public latlon=[];

  constructor(public navCtrl: NavController, 
    public locationTracker: LocationTrackerProvider,
    public geoLocation : Geolocation,
    public http: HttpClient) {
 
  }


  // start(){
  //   this.locationTracker.startTracking();
  // }
 
  // stop(){
  //   this.locationTracker.stopTracking();
  // }
 
  ionViewDidLoad() {
    this.loadMap();
  }  

  loadMap() {
   
    this.geoLocation.getCurrentPosition().then((res) => {
      this.center = [res.coords.latitude  , res.coords.longitude];      
      let pos = [res.coords.latitude  , res.coords.longitude];



      let mapOption = {
        center: this.center,
        zoom: 15
      };
  
      this.map = L.map('map', mapOption);
      this.marker = L.marker();
  
      L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attributions: 'OSM',
        maxZoom: 20
      }).addTo(this.map);
  

      this.http.get("http://www2.cgistln.nu.ac.th/budgetview/landmark/all_geojson.php?type=marker&region=&prov_name=&_name=%20&tam_name=&project_group=&type_project=&sub_project_group=&strategic20=&substrategic20=&economic_plan=&economic_target=&economic_measure=&integration_29=&integration_target=&user=24&chain_activities=").subscribe(res => {
        //this.latlon.push([Number(res[0].coordinates.lat), Number(res[0].coordinates.lon)]);
        L.marker([Number(res[0].lat), Number(res[0].lon)]).addTo(this.map);
        console.log(res);
      })     

       
     


      var LeafIcon = L.Icon.extend({
        options: {
          iconSize:     [30, 40], // size of the icon
          iconAnchor:   [10, 30]
        }
      });
    
      var greenIcon = new LeafIcon({iconUrl: 'http://icon-park.com/imagefiles/location_map_pin_orange3.png'});
 
  

      this.marker = L.marker(pos, {icon: greenIcon}).bindPopup('Hello').addTo(this.map);
      this.circle = L.circle(pos, {radius: 500}).addTo(this.map);        




    



    })
  
  } 
 
}