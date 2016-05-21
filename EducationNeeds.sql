CREATE view vw_7046ProvinceDistrictLocalEducationServiceBursariesNeeds
AS 

SELECT        CaptureYear, 	Province, District, LocalMunicipality, NeedEducationServiceBursaries, 
	COUNT(NeedEducationServiceBursaries) AS TotalNeedEducationServiceBursaries
FROM            dbo.tbl_7046EducationHavesNeeds
GROUP BY CaptureYear, Province, District, LocalMunicipality, NeedEducationServiceBursaries
order by 1,2
------------------------------------------------------------------------------------------

select a.CaptureYear,a.Province,a.District,a.LocalMunicipality, 
coalesce(a.neededucationservicefeeding,b.NeedEducationServiceScholarTransport,c.NeedEducationServiceFees,d.NeedEducationServiceTextbooks,
e.NeedEducationServiceABET,NeedEducationServiceBursaries) as EducationNeeds,
a.TotalNeedEducationServiceFeeding, b.TotalNeedEducationServiceScholarTransport, c.TotalNeedEducationServiceFees,d.TotalNeedEducationTextbooks,e.TotalNeedEducationServiceABET,
(a.TotalNeedEducationServiceFeeding + b.TotalNeedEducationServiceScholarTransport + c.TotalNeedEducationServiceFees + 
d.TotalNeedEducationTextbooks + e.TotalNeedEducationServiceABET + f.TotalNeedEducationServiceBursaries) as TotalEducationServiceNeeds

from vw_7046ProvinceDistrictLocalEducationServiceFeedingNeeds a 
inner join [dbo].[vw_7046ProvinceDistrictLocalEducationServiceScholarTransportNeeds] b
on a.Province = b.Province
--on a.CaptureYear = b.CaptureYear
inner join vw_7046ProvinceDistrictLocalEducationServiceFeesNeeds c 
on a.Province = c.Province 

inner join vw_7046ProvinceDistrictLocalEducationServiceTextbooksNeeds d
on a.Province = d.Province

inner join vw_7046ProvinceDistrictLocalEducationServiceABETNeeds e
on a.Province = e.Province

inner join [dbo].[vw_7046ProvinceDistrictLocalEducationServiceBursariesNeeds] f
on a.Province = f.Province

and a.CaptureYear= b.CaptureYear
and a.CaptureYear = c.CaptureYear
and a.CaptureYear = d.CaptureYear
and a.CaptureYear = e.CaptureYear
and a.CaptureYear = f.CaptureYear

--and b.CaptureYear = c.CaptureYear
and a.District = b.District
and a.district = c.district
and a.District = d.District
and a.District = e.District
and a.District = f.District

and a.LocalMunicipality= b.LocalMunicipality
and a.LocalMunicipality = c.LocalMunicipality
and a.LocalMunicipality = d.LocalMunicipality
and a.LocalMunicipality = e.LocalMunicipality
and a.LocalMunicipality = f.LocalMunicipality

and a.NeedEducationServiceFeeding = b.NeedEducationServiceScholarTransport
and a.NeedEducationServiceFeeding = c.NeedEducationServiceFees
and a.NeedEducationServiceFeeding = d.NeedEducationServiceTextbooks
and a.NeedEducationServiceFeeding = e.NeedEducationServiceABET
and a.NeedEducationServiceFeeding = f.NeedEducationServiceBursaries
--where a.CaptureYear = 2013
order by 1,2