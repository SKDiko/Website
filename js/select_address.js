var provinceName = document.getElementById("province");
var townName = document.getElementById("town");
var suburbName = document.getElementById("suburb");
var code = document.getElementById("code");

provinceName.onchange = function() {
	townName.value = "";
    suburbName.value = "";
    line1.value = "";
    line2.value = "";
    code.value = "";
}

townName.onfocus = function() {
	if(provinceName.value == "Eastern Cape") {
        document.getElementById("Gqeberha").hidden = false;
        document.getElementById("Johannesburg").hidden = true;
        document.getElementById("Bhisho").hidden = false;
        document.getElementById("Polokwane").hidden = true;
        document.getElementById("Bloemfontein").hidden = true;
        document.getElementById("Mbombela").hidden = true;
        document.getElementById("Mahikeng").hidden = true;
        document.getElementById("Kimberley").hidden = true;
        document.getElementById("Cape_Town").hidden = true;
        document.getElementById("Pietermarizburg").hidden = true;
        document.getElementById("Durban").hidden = true;
    
    } else if(provinceName.value == "Gauteng") {
        document.getElementById("Gqeberha").hidden = true;
        document.getElementById("Johannesburg").hidden = false;
        document.getElementById("Bhisho").hidden = true;
        document.getElementById("Polokwane").hidden = true;
        document.getElementById("Bloemfontein").hidden = true;
        document.getElementById("Mbombela").hidden = true;
        document.getElementById("Mahikeng").hidden = true;
        document.getElementById("Kimberley").hidden = true;
        document.getElementById("Cape_Town").hidden = true;
        document.getElementById("Pietermarizburg").hidden = true;
        document.getElementById("Durban").hidden = true;
    
    }else if(provinceName.value == "Limpopo") {
        document.getElementById("Gqeberha").hidden = true;
        document.getElementById("Johannesburg").hidden = true;
        document.getElementById("Bhisho").hidden = true;
        document.getElementById("Polokwane").hidden = false;
        document.getElementById("Bloemfontein").hidden = true;
        document.getElementById("Mbombela").hidden = true;
        document.getElementById("Mahikeng").hidden = true;
        document.getElementById("Kimberley").hidden = true;
        document.getElementById("Cape_Town").hidden = true;
        document.getElementById("Pietermarizburg").hidden = true;
        document.getElementById("Durban").hidden = true;
    
    } else if(provinceName.value == "Free State") {
        document.getElementById("Gqeberha").hidden = true;
        document.getElementById("Johannesburg").hidden = true;
        document.getElementById("Bhisho").hidden = true;
        document.getElementById("Polokwane").hidden = true;
        document.getElementById("Bloemfontein").hidden = false;
        document.getElementById("Mbombela").hidden = true;
        document.getElementById("Mahikeng").hidden = true;
        document.getElementById("Kimberley").hidden = true;
        document.getElementById("Cape_Town").hidden = true;
        document.getElementById("Pietermarizburg").hidden = true;
        document.getElementById("Durban").hidden = true;

    } else if(provinceName.value == "Mpumalanga") {
        document.getElementById("Gqeberha").hidden = true;
        document.getElementById("Johannesburg").hidden = true;
        document.getElementById("Bhisho").hidden = true;
        document.getElementById("Polokwane").hidden = true;
        document.getElementById("Bloemfontein").hidden = true;
        document.getElementById("Mbombela").hidden = false;
        document.getElementById("Mahikeng").hidden = true;
        document.getElementById("Kimberley").hidden = true;
        document.getElementById("Cape_Town").hidden = true;
        document.getElementById("Pietermarizburg").hidden = true;
        document.getElementById("Durban").hidden = true;
    
    } else if(provinceName.value == "North West") {
        document.getElementById("Gqeberha").hidden = true;
        document.getElementById("Johannesburg").hidden = true;
        document.getElementById("Bhisho").hidden = true;
        document.getElementById("Polokwane").hidden = true;
        document.getElementById("Bloemfontein").hidden = true;
        document.getElementById("Mbombela").hidden = true;
        document.getElementById("Mahikeng").hidden = false;
        document.getElementById("Kimberley").hidden = true;
        document.getElementById("Cape_Town").hidden = true;
        document.getElementById("Pietermarizburg").hidden = true;
        document.getElementById("Durban").hidden = true;
        
    } else if(provinceName.value == "Northern Cape") {
        document.getElementById("Gqeberha").hidden = true;
        document.getElementById("Johannesburg").hidden = true;
        document.getElementById("Bhisho").hidden = true;
        document.getElementById("Polokwane").hidden = true;
        document.getElementById("Bloemfontein").hidden = true;
        document.getElementById("Mbombela").hidden = true;
        document.getElementById("Mahikeng").hidden = true;
        document.getElementById("Kimberley").hidden = false;
        document.getElementById("Cape_Town").hidden = true;
        document.getElementById("Pietermarizburg").hidden = true;
        document.getElementById("Durban").hidden = true;

    } else if(provinceName.value == "Western Cape") {
        document.getElementById("Gqeberha").hidden = true;
        document.getElementById("Johannesburg").hidden = true;
        document.getElementById("Bhisho").hidden = true;
        document.getElementById("Polokwane").hidden = true;
        document.getElementById("Bloemfontein").hidden = true;
        document.getElementById("Mbombela").hidden = true;
        document.getElementById("Mahikeng").hidden = true;
        document.getElementById("Kimberley").hidden = true;
        document.getElementById("Cape_Town").hidden = false;
        document.getElementById("Pietermarizburg").hidden = true;
        document.getElementById("Durban").hidden = true;
    
    } else if(provinceName.value == "KwaZulu-Natal") {
        document.getElementById("Gqeberha").hidden = true;
        document.getElementById("Johannesburg").hidden = true;
        document.getElementById("Bhisho").hidden = true;
        document.getElementById("Polokwane").hidden = true;
        document.getElementById("Bloemfontein").hidden = true;
        document.getElementById("Mbombela").hidden = true;
        document.getElementById("Mahikeng").hidden = true;
        document.getElementById("Kimberley").hidden = true;
        document.getElementById("Cape_Town").hidden = true;
        document.getElementById("Pietermarizburg").hidden = false;
        document.getElementById("Durban").hidden = false;
        
    } else {
        document.getElementById("Gqeberha").hidden = true;
        document.getElementById("Johannesburg").hidden = true;
        document.getElementById("Bhisho").hidden = true;
        document.getElementById("Polokwane").hidden = true;
        document.getElementById("Bloemfontein").hidden = true;
        document.getElementById("Mbombela").hidden = true;
        document.getElementById("Mahikeng").hidden = true;
        document.getElementById("Kimberley").hidden = true;
        document.getElementById("Cape_Town").hidden = true;
        document.getElementById("Pietermarizburg").hidden = true;
        document.getElementById("Durban").hidden = true;
    }
}

townName.onchange = function() {
    suburbName.value = "";
    line1.value = "";
    line2.value = "";
    code.value = "";
}

suburbName.onfocus = function() {
	if(townName.value == "Mbombela") {
        document.getElementById("Kamagugu").hidden = false;
        document.getElementById("Essenwood").hidden = true;
        document.getElementById("Bridgemead").hidden = true;
        document.getElementById("Kenville").hidden = true;
        document.getElementById("Humewood").hidden = true;
        document.getElementById("Cato_Manor").hidden = true;
        document.getElementById("Algoa_Park").hidden = true;
        document.getElementById("Musgrave").hidden = true;
        document.getElementById("Barberton").hidden = false;
        document.getElementById("Bluff").hidden = true;
        document.getElementById("Cotswold").hidden = true;
        document.getElementById("Glenmore").hidden = true;
        document.getElementById("Riverside").hidden = false;
        document.getElementById("Lorraine").hidden = true;
        document.getElementById("Kwamashu").hidden = true;
        document.getElementById("Inanda").hidden = true;
        document.getElementById("Struandale").hidden = true;
        document.getElementById("Valencia_Park").hidden = false;
        document.getElementById("Tongaat").hidden = true;
        document.getElementById("Greyville").hidden = true;
        document.getElementById("Malabar").hidden = true;
        document.getElementById("Summerstrand").hidden = true;
    
    } else if(townName.value == "Durban") {
        document.getElementById("Kamagugu").hidden = true;
        document.getElementById("Essenwood").hidden = false;
        document.getElementById("Bridgemead").hidden = true;
        document.getElementById("Kenville").hidden = false;
        document.getElementById("Humewood").hidden = true;
        document.getElementById("Cato_Manor").hidden = false;
        document.getElementById("Algoa_Park").hidden = true;
        document.getElementById("Musgrave").hidden = false;
        document.getElementById("Barberton").hidden = true;
        document.getElementById("Bluff").hidden = false;
        document.getElementById("Cotswold").hidden = true;
        document.getElementById("Glenmore").hidden = false;
        document.getElementById("Riverside").hidden = true;
        document.getElementById("Lorraine").hidden = true;
        document.getElementById("Kwamashu").hidden = false;
        document.getElementById("Inanda").hidden = false;
        document.getElementById("Struandale").hidden = true;
        document.getElementById("Valencia_Park").hidden = true;
        document.getElementById("Tongaat").hidden = false;
        document.getElementById("Greyville").hidden = false;
        document.getElementById("Malabar").hidden = true;
        document.getElementById("Summerstrand").hidden = true;

    } else if(townName.value == "Gqeberha") {
        document.getElementById("Kamagugu").hidden = true;
        document.getElementById("Essenwood").hidden = true;
        document.getElementById("Bridgemead").hidden = false;
        document.getElementById("Kenville").hidden = true;
        document.getElementById("Humewood").hidden = false;
        document.getElementById("Cato_Manor").hidden = true;
        document.getElementById("Algoa_Park").hidden = false;
        document.getElementById("Musgrave").hidden = true;
        document.getElementById("Barberton").hidden = true;
        document.getElementById("Bluff").hidden = true;
        document.getElementById("Cotswold").hidden = false;
        document.getElementById("Glenmore").hidden = true;
        document.getElementById("Riverside").hidden = true;
        document.getElementById("Lorraine").hidden = false;
        document.getElementById("Kwamashu").hidden = true;
        document.getElementById("Inanda").hidden = true;
        document.getElementById("Struandale").hidden = false;
        document.getElementById("Valencia_Park").hidden = true;
        document.getElementById("Tongaat").hidden = true;
        document.getElementById("Greyville").hidden = true;
        document.getElementById("Malabar").hidden = false;
        document.getElementById("Summerstrand").hidden = false;

    } else {
        document.getElementById("Kamagugu").hidden = true;
        document.getElementById("Essenwood").hidden = true;
        document.getElementById("Bridgemead").hidden = true;
        document.getElementById("Kenville").hidden = true;
        document.getElementById("Humewood").hidden = true;
        document.getElementById("Cato_Manor").hidden = true;
        document.getElementById("Algoa_Park").hidden = true;
        document.getElementById("Musgrave").hidden = true;
        document.getElementById("Barberton").hidden = true;
        document.getElementById("Bluff").hidden = true;
        document.getElementById("Cotswold").hidden = true;
        document.getElementById("Glenmore").hidden = true;
        document.getElementById("Riverside").hidden = true;
        document.getElementById("Lorraine").hidden = true;
        document.getElementById("Kwamashu").hidden = true;
        document.getElementById("Inanda").hidden = true;
        document.getElementById("Struandale").hidden = true;
        document.getElementById("Valencia_Park").hidden = true;
        document.getElementById("Tongaat").hidden = true;
        document.getElementById("Greyville").hidden = true;
        document.getElementById("Malabar").hidden = true;
        document.getElementById("Summerstrand").hidden = true;
    }
}

suburbName.onchange = function() {
    line1.value = "";
    line2.value = "";
    
	if(suburbName.value == "Kamagugu") {
        code.value = "1200";

    } else if(suburbName.value == "Essenwood" || suburbName.value == "Musgrave" || suburbName.value == "Glenmore" || suburbName.value == "Greyville") {
        code.value = "4001";
    
    } else if(suburbName.value == "Bridgemead") {
        code.value = "6025";
    
    } else if(suburbName.value == "Kenville") {
        code.value = "4051";

    } else if(suburbName.value == "Humewood" || suburbName.value == "Algoa Park" || suburbName.value == "Struandale" || suburbName.value == "Summerstrand") {
        code.value = "6001";

    } else if(suburbName.value == "Cato Manor") {
        code.value = "4091";

    } else if(suburbName.value == "Barberton") {
        code.value = "1300";
        
    } else if(suburbName.value == "Bluff") {
        code.value = "4052";
        
    } else if(suburbName.value == "Cotswold") {
        code.value = "6045";
        
    } else if(suburbName.value == "Riverside") {
        code.value = "1226";
        
    } else if(suburbName.value == "Lorraine") {
        code.value = "6070";
        
    } else if(suburbName.value == "Kwamashu") {
        code.value = "4359";
        
    } else if(suburbName.value == "Inanda") {
        code.value = "4309";
            
    } else if(suburbName.value == "Valencia Park") {
        code.value = "1201";
            
    } else if(suburbName.value == "Tongaat") {
        code.value = "4399";
            
    } else if(suburbName.value == "Malabar") {
        code.value = "6020";
        
    } else {
        code.value = ""; 
    }
}