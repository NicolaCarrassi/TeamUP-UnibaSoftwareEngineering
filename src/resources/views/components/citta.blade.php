 <div class="input-group">
     <select class="custom-select" id="citta" name="city" aria-label="Dropdown menu citta" data-browse="down">
         @if($db_city === null)
             @if(old('city') === null)
                 <option value="Seleziona una città...">Seleziona una città...</option>
                 @foreach($citta as $city)
                     <option value="{{$city->city}}"> {{$city->city}} </option>
                 @endforeach
             @else
                 <option value="{{old('city')}}" selected> {{old('city')}} </option>
                 @foreach($citta as $city)
                     @if($city->city !== old('city'))
                         <option value="{{$city->city}}"> {{$city->city}} </option>
                     @endif
                 @endforeach
             @endif
         @else
             <option value="{{old('city') ?? $db_city}}" selected> {{old('city') ?? $db_city}} </option>
             <option value="Seleziona una città...">Seleziona una città...</option>
             @if(old('city') === null)
                 @foreach($citta as $city)
                     @if($city->city !== $db_city)
                         <option value="{{$city->city}}"> {{$city->city}} </option>
                     @endif
                 @endforeach
             @else
                 @foreach($citta as $city)
                     @if($city->city !== old('city'))
                         <option value="{{$city->city}}"> {{$city->city}} </option>
                     @endif
                 @endforeach
             @endif
         @endif
     </select>
 </div>
