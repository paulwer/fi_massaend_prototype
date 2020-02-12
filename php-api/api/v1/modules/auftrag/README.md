# Endpoint for user
1 GET ({id}) get informations about a user
FLAGS:  1 data
        2 employee
        3 instructor
        4 office_worker
Return-Codes:
200 - Found
400 - Bad Request (missing id)
404 - Not found. User not exsist