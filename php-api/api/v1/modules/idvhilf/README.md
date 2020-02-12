# Endpoint for user
1 GET ({srplus_ticketnr, auftragsnummer}) get informations about a idvhilf
2 GET ({srplus_ticketnr, auftragsnummer, data}) + a part of the data, which is existing in db
200 - Found
400 - Bad Request (missing get param)
