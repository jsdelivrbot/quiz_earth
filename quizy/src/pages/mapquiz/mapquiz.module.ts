import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { MapquizPage } from './mapquiz';

@NgModule({
  declarations: [
    MapquizPage,
  ],
  imports: [
    IonicPageModule.forChild(MapquizPage),
  ],
})
export class MapquizPageModule {}
