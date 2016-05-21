--Health Quaries
Select m.* 
into tbl_7046ProvinceDistrictLocalHealthNeeds
From
(
select [YEAR],Province,District,LocalMunicipality,[HaveDifficultyVisual] as Needs, 
count(*) as [HaveDifficultyVisual],count(*) as [HaveDifficultyHearing],count(*) as[HaveDifficultyCommunication],count(*) as [HaveDifficultyPhysical],count(*) as [HaveDifficultyMental],
				count(*) as [HaveDifficultySelfCare],count(*) as [HasPermanentDisability],count(*) as [PermanentDifficultyVisual],
				count(*) as [PermanentDifficultyHearing],count(*) as [PermanentDifficultyCommunication],count(*) as [PermanentDifficultyPhysical],count(*) as [PermanentDifficultyMental],
				count(*) as [PermanentDifficultySelfCare],count(*) as [UsesChronicMedication],count(*) as [UsesEyeGlasses],count(*) as [UsesHearingAid],count(*) as [UsesWalkingStickFrame],count(*) as [UsesWheelchair],
				--Needs
				count(*) as [NeedHealthServiceRTC],count(*) as [NeedHealthServiceTreatment],count(*) as [NeedHealthServiceCheckUp],count(*) as [NeedHealthServiceRehab],
				count(*) as [NeedHealthServiceAssistiveDevice],count(*) as [NeedHealthServiceNutrition],count(*) as [NeedHealthServiceVCT],count(*) as [NeedHealthServiceImmu],count(*) as [NeedHealthServiceWeight],
				--Need Female Health
				count(*) as [NeedFemaleHealthServiceNotSelected],count(*) as [NeedFemaleHealthServicePMTCT],count(*) as [NeedFemaleHealthServicePrePostNatalCare],count(*) as [NeedFemaleHealthServicePapSmear],
				count(*) as [NeedFemaleHealthServiceFamilyPlanning],count(*) as [NeedFemaleHealthServiceOther],count(*) as [NeedFemaleHealthServiceNone],count(*) as[NeedFemaleHealthServiceDontKnow], count(*) as TotalNeedsCount
from [dbo].vw_7046SocialProf_HealthWithYear
group by [YEAR],Province,District,LocalMunicipality,[HaveDifficultyVisual]

) m
